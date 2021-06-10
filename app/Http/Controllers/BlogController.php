<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'body' => 'required',
        ]);

        $blog = new Blog([
            'title' => $request->get('title'),
            'category' => $request->get('category'),
            'body' => $request->get('body'),
        ]);

        $blog->save();
        return response()->json([
            'message' => 'Blog Created',
            'Blog' => $blog
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'body' => 'required',
        ]);
        if (Blog::where('id', $id)->exists()) {
            $blog = Blog::find($id);
            $blog->title =  $request->get('title');
            $blog->category = $request->get('category');
            $blog->body = $request->get('body');
            $blog->save();
            return response()->json([
                'message' => 'Blog Updated',
                'Blog' => $blog
            ]);
        } else {
            return response()->json([
                "message" => "Blog not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Blog::where('id', $id)->exists()) {
            $blog = Blog::find($id);
            $blog->delete();
            return response()->json(['message' => 'Blog Deleted']);
        } else {
            return response()->json([
                "message" => "Blog not found"
            ], 404);
        }
    }
}
