<div class="mb-3"><label>Tiêu đề</label><input class="form-control" name="title" value="{{ old('title', $post?->title) }}" required></div>
<div class="mb-3"><label>Slug</label><input class="form-control" name="slug" value="{{ old('slug', $post?->slug) }}" required></div>
<div class="mb-3"><label>Nội dung</label><textarea class="form-control" name="content" rows="6">{{ old('content', $post?->content) }}</textarea></div>
<div class="mb-3"><label>Người viết</label><select class="form-select" name="user_id" required>
        <option value="">-- Chọn người viết --</option>@foreach($users as $author)<option value="{{ $author->userid }}" @selected(old('user_id', $post?->user_id) == $author->userid)>{{ $author->fullname }}</option>@endforeach
    </select></div>
<div class="mb-3"><label>Trạng thái</label><select class="form-select" name="status">
        <option value="1" @selected(old('status', $post?->status ?? 1) == 1)>Xuất bản</option>
        <option value="0" @selected(old('status', $post?->status) == 0)>Nháp</option>
    </select></div>