<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Tên phòng ban <span style="color: red">*</span></label>
        <input type="text" name="name" placeholder="Tên nhóm ..." class="form-control"
            value="{{ old('name', $department->name ?? '') }}">
        @error('name')
            <small id="" class="form-text text-danger">{{ $errors->first('name') }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Mô tả</label>
        <textarea name="description" id="" class="form-control" placeholder="Mô tả ..." cols="30" rows="3">{{ old('description', $department->description ?? '') }}</textarea>
        @error('description')
            <small id="" class="form-text text-danger">{{ $errors->first('description') }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Hình ảnh</label>
        <input type="file" class="form-control" name="avatar">

        @if (isset($department->avatar) && $department->avatar)
            <img src="{{ pare_url_file($department->avatar) }}"
                style="width: 60px; height: 60px; border-radius: 10px; margin-top: 10px" alt="">
        @endif
        
    </div>
    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
</form>
