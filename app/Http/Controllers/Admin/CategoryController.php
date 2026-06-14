<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  "category index";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "trang tao category";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "luu category";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "category show: " ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "trang sua category: " ;
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return  "trang cap nhat category: ";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "xoa category: " ;
    }
}