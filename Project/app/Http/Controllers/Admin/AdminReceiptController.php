<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use Illuminate\Http\Request;

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
    // Xóa hóa đơn
    // public function destroy($id)
    // {
    //     $receipt = Receipt::findOrFail($id);

    //     // Xóa liên kết với các booking trước khi xóa hóa đơn
    //     $receipt->bookings()->detach();
    //     $receipt->delete();

    //     return redirect()->route('admin.receipts.index')->with('success', 'Hóa đơn đã được xóa thành công.');
    // }
    public function destroy($id)
    {
        $receipt = Receipt::findOrFail($id);

        foreach ($receipt->bookings as $booking) {
            $booking->customer()->delete();  
            $booking->delete();
        }

        $receipt->delete();

        return redirect()->route('admin.receipts.index')->with('success', 'Hóa đơn và các thông tin liên quan đã được xóa thành công.');
    }
}
