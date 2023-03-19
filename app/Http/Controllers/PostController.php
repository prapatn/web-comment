<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);

        Posts::create([
            'title' => $request['title'],
            'message' => $request['message'],
            'user_id' => Auth::user()->id,
        ]);
        return redirect()
            ->back()
            ->with('success', 'เพิ่มโพสใหม่สำเร็จ');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Posts::find($id);
        if (!$post) {
            abort(404);
        }
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $post = Posts::where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();
            if (!$post) {
                abort(404);
            }
            $post->delete();

            return redirect()
                ->back()
                ->with('success', 'ลบโพสสำเร็จ');
        } catch (\Throwable $th) {
            return abort(403);
        }
    }
}
