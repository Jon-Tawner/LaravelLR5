<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use Barryvdh\Debugbar\Facades\Debugbar;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pageSize = 2;
        $blogs = Blog::simplePaginate($pageSize);

        return view('blog.showBlogs', compact([
            'blogs',
        ]));
    }

    public function my() {
        $pageSize = 2;
        $blogs = Auth::user()->blogs()->simplePaginate($pageSize);

        return view('blog.myBlogs', compact([
            'blogs',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $blog = new Blog([
            'title' => $request->title,
            'src' => $request->img,
            'content' => $request->text,
        ]);

        Auth::user()->blogs()->save($blog);
        return redirect(route('my_blogs'))->with('status', 'Блог добавлен');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog) {
        return view('blog.edit', compact(['blog']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $blog->update($request->all());

        return redirect(route('all_blogs'))->with('status', 'Блог Изменён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function delete(Blog $blog) {
        $blog->delete();

        return redirect()->back()->with('status', 'Блог delitin');
    }

    public function saveBlogsFile($path_To_File) {
        $content = Storage::get($path_To_File);

        $Data = str_getcsv($content, "\n"); //parse the rows 

        foreach ($Data as &$Row) {
            $Row = str_getcsv($Row, ";");
            $blog = new Blog([
                'title' => $Row[0],
                'src' => $Row[1],
                'content' => $Row[2],
            ]);

            Auth::user()->blogs()->save($blog);
        }
    }

    public function unpack(Request $request) {
        $validated = $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $file->storeAs('blogs', 'data.csv');

        $this->saveBlogsFile('blogs/data.csv');

        return redirect(route('all_blogs'))->with('status', 'Распаковали вроде');
    }

    public function load() {
        return view('admin.blog.load');
    }
}
