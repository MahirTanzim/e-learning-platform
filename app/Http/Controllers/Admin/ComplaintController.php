<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::with('complainant');

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $complaints = $query->latest()->paginate(15);

        return view('admin.complaints.index', compact('complaints'));
    }

    public function show(Complaint $complaint)
    {
        return view('admin.complaints.show', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'admin_response' => 'nullable|string',
        ]);

        $complaint->update([
            'status' => $request->status,
            'admin_response' => $request->admin_response,
        ]);

        return back()->with('success', 'Complaint updated successfully!');
    }
}