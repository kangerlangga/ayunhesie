<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Comments',
            'DataC' => Comment::latest()->get(),
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.comment', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'New Comment',
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.comment_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form
        $request->validate([
            'Author'    => 'required|max:255',
            'Comment'   => 'required',
            'Email'     => 'required|email|max:255',
            'Phone'     => 'required|numeric|max_digits:20',
        ]);

        //create
        Comment::create([
            'id_comments'       => 'Comment'.Str::random(33),
            'author_comments'   => $request->Author,
            'content_comments'  => $request->Comment,
            'email_comments'    => $request->Email,
            'phone_comments'    => $request->Phone,
            'visib_comments'    => $request->visibility,
            'created_by'        => Auth::user()->email,
            'modified_by'       => Auth::user()->email,
        ]);

        //redirect to index
        return redirect()->route('comment.add')->with(['success' => 'Comment has been Added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data = [
            'judul' => 'Edit Comment',
            'EditComment' => Comment::findOrFail($id),
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.comment_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'Author'    => 'required|max:255',
            'Comment'   => 'required',
            'Email'     => 'required|email|max:255',
            'Phone'     => 'required|numeric|max_digits:20',
        ]);

        $comment = Comment::findOrFail($id);

        $comment->update([
            'author_comments'   => $request->Author,
            'content_comments'  => $request->Comment,
            'email_comments'    => $request->Email,
            'phone_comments'    => $request->Phone,
            'visib_comments'    => $request->visibility,
            'modified_by'       => Auth::user()->email,
        ]);

        return redirect()->route('comment.data')->with(['success' => 'Comment has been Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $comment = Comment::findOrFail($id);

        //delete
        $comment->delete();

        //redirect to index
        return redirect()->route('comment.data')->with(['success' => 'Comment has been Deleted!']);
    }
}
