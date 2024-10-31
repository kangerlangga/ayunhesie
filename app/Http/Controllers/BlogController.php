<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Blogs',
            'DataB' => Blog::latest()->get(),
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.blog', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'New Article',
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.blog_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form
        $request->validate([
            'Thumbnail' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'Title'     => 'required|max:255',
            'Content'   => 'required',
        ]);

        //upload image
        $thumb = $request->file('Thumbnail');
        $thumbName = time().Str::random(17).'.'.$thumb->getClientOriginalExtension();
        $thumb->move('assets1/img/Blog', $thumbName);

        //create
        Blog::create([
            'id_blog'           => 'Blogs'.Str::random(33),
            'id_detail'         => Str::random(19),
            'title_blog'        => $request->Title,
            'content_blog'      => $request->Content,
            'thumbnail_blog'    => $thumbName,
            'author_blog'       => $request->Author,
            'visib_blog'        => $request->visibility,
            'created_by'        => Auth::user()->email,
            'modified_by'       => Auth::user()->email,
        ]);

        //redirect to index
        return redirect()->route('blog.add')->with(['success' => 'Article has been Added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blogData = Blog::where('id_detail', $id)->where('visib_blog', 'Showing')->firstOrFail();

        $data = [
            'judul' => $blogData->title_blog,
            'DetailBlog' => $blogData,
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.public.blog_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data = [
            'judul' => 'Edit Article',
            'EditArticle' => Blog::findOrFail($id),
            'cOP' => Order::where('status_orders', 'Pending')->count(),
        ];
        return view('pages.admin.blog_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'Thumbnail' => 'image|mimes:jpeg,jpg,png|max:3072',
            'Title'     => 'required|max:255',
            'Content'   => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('Thumbnail')) {
            $ThumbnailPath = 'assets1/img/Blog/' . $blog->thumbnail_blog;
            if (file_exists($ThumbnailPath)) {
                unlink($ThumbnailPath);
            }
            $Thumbnail = $request->file('Thumbnail');
            $ThumbnailName = time() . Str::random(17) . '.' . $Thumbnail->getClientOriginalExtension();
            $Thumbnail->move('assets1/img/Blog', $ThumbnailName);
        } else {
            $ThumbnailName = $blog->thumbnail_blog;
        }

        $blog->update([
            'title_blog'        => $request->Title,
            'content_blog'      => $request->Content,
            'thumbnail_blog'    => $ThumbnailName,
            'author_blog'       => $request->Author,
            'visib_blog'        => $request->visibility,
            'modified_by'       => Auth::user()->email,
        ]);

        return redirect()->route('blog.data')->with(['success' => 'Article has been Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $blog = Blog::findOrFail($id);

        //delete image
        $blog_path = 'assets1/img/Blog/' . $blog->thumbnail_blog;
        if (file_exists($blog_path)) {
            unlink($blog_path);
        }

        //delete
        $blog->delete();

        //redirect to index
        return redirect()->route('blog.data')->with(['success' => 'Article has been Deleted!']);
    }
}
