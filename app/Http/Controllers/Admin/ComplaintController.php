<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('complainant')
                              ->latest()
                              ->paginate(15);

        return view('admin.complaints.index', compact('complaints'));
    }

    public function show(Complaint $complaint)
    {
        $complaint->load('complainant');
        return view('admin.complaints.show', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'admin_response' => 'nullable|string|max:1000',
        ]);

        $complaint->update([
            'status' => $request->status,
            'admin_response' => $request->admin_response,
        ]);

        return redirect()->route('admin.complaints.show', $complaint)
                        ->with('success', 'Complaint updated successfully!');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();

        return redirect()->route('admin.complaints.index')
                        ->with('success', 'Complaint deleted successfully!');
    }
}