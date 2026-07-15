<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    // Hiển thị trang đăng nhập
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    // Xử lý đăng nhập
    public function postLogin(Request $request)
    {
        // validate - kiểm tra dữ liệu đầu vào
        // bổ sung thêm một số ràng buộc khác - nếu có
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'username' => 'Tên đăng nhập',
                'password' => 'Mật khẩu',
            ]
        );
        // first(): lấy ra record đầu tiên khi truy vấn dữ liệu
        $user = User::where('username', $request->username)->first();
        // Nếu không tìm thấy người dùng trong bảng users
        if (!$user) {
            return back()
                ->with('message', 'Username không tồn tại')
                ->withInput();
        }
        // Nếu tìm thấy người dùng thì kiểm tra mật khẩu
        // do mật khẩu dùng Hash::make() để mã hóa, nên cần so sánh phải dùng với hàmHash::check()
        $check = Hash::check($request->password, $user->password); // true hoặc false
        // trường hợp mật khẩu không khớp
        if (!$check) {
            // điều hướng về trước (login) với session flash 'message'
            return back()->with('message', 'Mật khẩu không đúng')->withInput();
        }
        // Nếu biến $remember có giá trị true (nếu người dùng chọn nhớ tài khoản)
        $remember = $request->has('remember') ? true : false;
        Auth::login($user, $remember);
        // sử dụng intended để điều hướng về URL mà người dùng muốn truy cập
        // nếu không có thì điều hướng về dasboard (route name dashboard được khai báo trongweb.php)
        return redirect()->intended(route('admin.dashboard'));
    }
    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
    // Hiển thị trang Quên mật khẩu
     public function changePassword()
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->route('admin.login');
        }

        return view('admin.auth.change-password', compact('user'));
    }

    // Xử lý đổi mật khẩu
    public function postChangePassword(Request $request)
    {
        $request->validate(
            [
                'current_password' => ['required', 'string', 'min:6'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute phải có ít nhất :min ký tự',
                'confirmed' => 'Mật khẩu xác nhận không khớp',
            ],
            [
                'current_password' => 'Mật khẩu cũ',
                'password' => 'Mật khẩu mới',
            ]
        );

        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->route('admin.login');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->with('error', 'Mật khẩu cũ không chính xác')
                ->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công');
    }

    // Hiển thị trang Quên mật khẩu
    public function forgotPassword()
    {
        return view('admin.users.forgotpassword');
    }

    // Xử lý quên mật khẩu
    public function postForgotpassword(Request $request)
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
            ],
            [
                'required' => ':attribute không được để trống',
                'email' => ':attribute không đúng định dạng',
            ],
            [
                'email' => 'Email',
            ]
        );

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->with('error', 'Email không tồn tại trong hệ thống')
                ->withInput();
        }

        $tempPassword = 'Admin@' . Str::random(6);
        $user->password = Hash::make($tempPassword);
        $user->save();

        return back()->with('success', 'Mật khẩu tạm thời đã được cấp: ' . $tempPassword);
    }
}
