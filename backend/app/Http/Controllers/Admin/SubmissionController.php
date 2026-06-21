<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;

class SubmissionController extends Controller
{
    public function index() {
        $submissions = ContactSubmission::orderByDesc('created_at')->paginate(20);
        return view('admin.submissions.index', compact('submissions'));
    }
    public function markRead(ContactSubmission $submission) {
        $submission->update(['is_read' => true]);
        return back()->with('success','Marked as read.');
    }
}
