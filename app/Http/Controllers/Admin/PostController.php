<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "post index";
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