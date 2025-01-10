<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index(Request $request)
{
    $sortBy = $request->get('sort_by', 'id');  
    $sortOrder = $request->get('sort_order', 'asc');  

    $contacts = Contact::orderBy($sortBy, $sortOrder)->get();

    return view('admin.contacts.index', compact('contacts', 'sortBy', 'sortOrder'));
}


    // Thêm liên hệ từ form user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Liên hệ của bạn đã được gửi thành công! Chúng tôi sẽ phản hồi sớm nhất qua email!');
    }

    // Xóa liên hệ
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Xóa liên hệ thành công!');
    }
}
