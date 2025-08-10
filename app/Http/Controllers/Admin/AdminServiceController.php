<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'service_id');
        $sortOrder = $request->get('sort_order', 'asc');
        $services = Service::
            orderBy($sortBy, $sortOrder)
            ->paginate(7);

        return view('admin.services.index', compact('services', 'sortBy', 'sortOrder'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Service::create($validated);
        return redirect()->back()->with('success', 'Dịch vụ đã được thêm thành công.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service = Service::findOrFail($id);
        $service->update($validated);
        return redirect()->back()->with('success', 'Dịch vụ đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->back()->with('success', 'Dịch vụ đã được xóa thành công.');
    }
}
