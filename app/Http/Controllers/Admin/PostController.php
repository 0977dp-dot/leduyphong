<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index($limit = 10)
    {
        $list = Post::query()
            ->leftJoin('users', 'posts.user_id', '=', 'users.userid')
            ->select('posts.*', 'users.fullname')
            ->orderByDesc('posts.id')
            ->paginate($limit);

        return view('admin.posts.index', compact('list'));
    }

    public function create()
    {
        $users = User::select('userid', 'fullname')->orderBy('fullname')->get();

        return view('admin.posts.create', compact('users'));
    }

    public function store(PostRequest $request)
    {
        try {
            Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => $request->user_id,
            ]);

            return redirect()->route('admin.posts.index')->with('success', 'Thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Thêm thất bại.');
        }
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $users = User::select('userid', 'fullname')->orderBy('fullname')->get();

        return view('admin.posts.edit', compact('post', 'users'));
    }

    public function update(PostRequest $request, string $id)
    {
        try {
            $post = Post::findOrFail($id);

            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'image' => $request->image,
                'status' => $request->status,
                'user_id' => $request->user_id,
            ]);

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Cập nhật thất bại.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Xóa bài viết thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xóa bài viết thất bại.');
        }
    }
}
