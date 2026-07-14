<div class="mb-3"><label>Họ tên</label><input class="form-control" name="fullname" value="{{ old('fullname', $user?->fullname) }}" required></div>
<div class="mb-3"><label>Tên đăng nhập</label><input class="form-control" name="username" value="{{ old('username', $user?->username) }}" required></div>
<div class="mb-3"><label>Email</label><input class="form-control" type="email" name="email" value="{{ old('email', $user?->email) }}" required></div>
<div class="mb-3"><label>Mật khẩu {{ $user ? '(để trống nếu không đổi)' : '' }}</label><input class="form-control" type="password" name="password" @unless($user) required @endunless></div>
<div class="mb-3"><label>Xác nhận mật khẩu</label><input class="form-control" type="password" name="password_confirmation" @unless($user) required @endunless></div>
<div class="mb-3"><label>Điện thoại</label><input class="form-control" name="phone" value="{{ old('phone', $user?->phone) }}" required></div>
<div class="mb-3"><label>Địa chỉ</label><input class="form-control" name="address" value="{{ old('address', $user?->address) }}"></div>
<div class="mb-3"><label>Giới tính</label><select class="form-select" name="gender"><option value="0" @selected(old('gender', $user?->gender) == 0)>Khác</option><option value="1" @selected(old('gender', $user?->gender) == 1)>Nam</option><option value="2" @selected(old('gender', $user?->gender) == 2)>Nữ</option></select></div>
<div class="mb-3"><label>Ngày sinh</label><input class="form-control" type="date" name="birthday" value="{{ old('birthday', $user?->birthday) }}"></div>
<div class="mb-3"><label>Vai trò</label><select class="form-select" name="role"><option value="0" @selected(old('role', $user?->role) == 0)>Người dùng</option><option value="1" @selected(old('role', $user?->role) == 1)>Quản trị viên</option></select></div>
<div class="mb-3"><label>Trạng thái</label><select class="form-select" name="status"><option value="1" @selected(old('status', $user?->status ?? 1) == 1)>Hoạt động</option><option value="0" @selected(old('status', $user?->status) == 0)>Khóa</option></select></div>
