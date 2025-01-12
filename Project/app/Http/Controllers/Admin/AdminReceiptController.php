<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PaymentSuccessMail;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Mail;
use TCPDF;

class AdminReceiptController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'receipt_id'); // Mặc định sắp xếp theo ID
        $sortOrder = $request->get('sort_order', 'asc'); // Mặc định sắp xếp theo thứ tự tăng dần

        $receipts = Receipt::orderBy($sortBy, $sortOrder)->paginate(7);

        $selectedReceipt = null;

        if ($request->has('id')) {
            $selectedReceipt = Receipt::with(['bookings.customer', 'bookings.room', 'payment'])
                ->find($request->get('id'));
        }

        return view('admin.receipts.index', compact('receipts', 'selectedReceipt', 'sortBy', 'sortOrder'));
    }

    public function show($id)
    {
        $selectedReceipt = Receipt::with(['bookings.customer', 'bookings.room', 'payment'])->findOrFail($id);

        return view('admin.receipts.show', compact('selectedReceipt'));
    }

    public function destroy($id)
    {
        $receipt = Receipt::findOrFail($id);

        foreach ($receipt->bookings as $booking) {
            $booking->room->status = 0;
            $booking->room->save();

            $booking->status = 0;

            $booking->customer()->delete();

            $booking->delete();
        }

        // Xóa receipt
        $receipt->delete();

        return redirect()->route('admin.receipts.index')->with('success', 'Hóa đơn và các thông tin liên quan đã được xóa thành công.');
    }

    public function exportPDF($id)
    {
        $receipt = Receipt::with(['bookings.customer', 'bookings.room', 'payment'])->findOrFail($id);

        $pdf = new TCPDF();

        $pdf->AddPage();

        $pdf->SetFont('dejavusans', '', 12);

        $html = view('admin.receipts.pdf', compact('receipt'))->render();

        $pdf->writeHTML($html);

        $pdfOutput = $pdf->output('', 'S'); // 'S' sẽ trả lại PDF dưới dạng chuỗi

        $email = $receipt->bookings->first()->customer->email;
        
        Mail::to($email)->send(new PaymentSuccessMail($receipt, $pdfOutput));  

        return $pdf->Output('receipt_' . $id . '.pdf', 'D');
    }
}
