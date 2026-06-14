<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "brand index";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "trang tao brand";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "luu brand";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "brand show: " ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "trang sua brand: " ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "trang cap nhat brand: " ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "xoa brand: " ;
    }
}