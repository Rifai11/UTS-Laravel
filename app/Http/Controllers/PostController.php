<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $posts = Post::latest()->paginate(5);

        //render view with posts
        return view('posts.index', compact('posts'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'foto_penduduk'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nik'     => 'required|min:5',
            'nama_penduduk'   => 'required|min:10'
        ]);

        //upload image
        $image = $request->file('foto_penduduk');
        $image->storeAs('public/posts', $image->hashName());

        //create post
        Post::create([
            'foto_penduduk'     => $image->hashName(),
            'nik'     => $request->nik,
            'nama_penduduk'   => $request->nama_penduduk
        ]);

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        //validate form
        $this->validate($request, [
            'foto_penduduk'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nik'     => 'required|min:5',
            'nama_penduduk'   => 'required|min:10'
        ]);

        //check if image is uploaded
        if ($request->hasFile('foto_penduduk')) {

            //upload new image
            $image = $request->file('foto_penduduk');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$post->foto_penduduk);

            //update post with new image
            $post->update([
                'foto_penduduk'     => $image->hashName(),
                'nik'     => $request->nik,
                'nama_penduduk'   => $request->nama_penduduk
            ]);

        } else {

            //update post without image
            $post->update([
                'nik'     => $request->nik,
                'nama_penduduk'   => $request->nama_penduduk
            ]);
        }

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy(Post $post)
    {
        //delete image
        Storage::delete('public/posts/'. $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('posts.index')->with(['success' =>'Data Berhasil Dihapus!!']);
    }
}