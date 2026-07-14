<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($limit = 10)
    {
        $list = User::orderByDesc('userid')->paginate($limit);

        return view('admin.users.index', compact('list'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
            User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'role' => $request->role,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.users.index')->with('success', 'Thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Thêm thất bại.');
        }
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        try {

            $user = User::findOrFail($id);

            $user->update([

                'fullname' => $request->fullname,

                'username' => $request->username,

                'email'    => $request->email,

                'password' => $request->password,

                'phone'    => $request->phone,

                'address'  => $request->address,

                'gender'   => $request->gender,

                'birthday' => $request->birthday,

                'role'     => $request->role,

                'status'   => $request->status,

            ]);

            return redirect()

                ->route('admin.users.index')

                ->with('success', 'Cập nhật thành công.');
        } catch (\Exception $e) {

            return redirect()

                ->back()

                ->withInput()

                ->with('error', 'Cập nhật thất bại.');
        }
    }
}
