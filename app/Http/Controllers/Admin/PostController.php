<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit=10)
    {
        $list = DB::table('users')
        ->select(
            'userid',
            'fullname',
            'username',
            'email',
            'phone',
            'address',
            'gender',
            'birthday',
            'role',
            'status'
        )
        ->orderBy('userid', 'desc')
        ->paginate(10);

    return view('admin.users.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return " tao post";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "luu post";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "post show: ";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "trang sua post: " ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "trang cap nhat post: " ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "xoa post: " ;
    }
}