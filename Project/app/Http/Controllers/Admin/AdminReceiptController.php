<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class AdminReceiptController extends Controller
{
    public function index(Request $request)
    {
        $receipts = Receipt::paginate(10);
        $selectedReceipt = null;

        if ($request->has('id')) {
            $selectedReceipt = Receipt::with(['bookings.customer', 'bookings.room', 'payment'])
                ->find($request->get('id'));
        }

        return view('admin.receipts.index', compact('receipts', 'selectedReceipt'));
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
        // Lấy hóa đơn và các thông tin liên quan
        $receipt = Receipt::with(['bookings.customer', 'bookings.room', 'payment'])->findOrFail($id);

        // Tạo PDF từ view
        $pdf = FacadePdf ::loadView('admin.receipts.pdf', compact('receipt'));

        // Xuất PDF và tải về
        return $pdf->download('receipt_' . $id . '.pdf');
    }
}
