@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Quản lý phòng bang</h2>
        <a href="{{ route('get_admin.department.create') }}" class="btn btn-primary" style="color: azure;">Thêm mới</a>
    </div>
    <form class="form-inline">
        <div class="form-group mb-2 mr-2">
            <label for="inputPassword2" class="sr-only">Tìm tên</label>
            <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}"
                placeholder="Nhập tên phòng ban ?">
        </div>

        <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>

    </form>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    {{-- <th>Avatar</th> --}}
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    {{-- <th>Slug</th> --}}
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments ?? [] as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        {{-- <td>
                            <img src="{{ pare_url_file($item->avatar) }}"
                                style="width: 60px; height: 60px; border-radius: 10px" alt="">
                        </td> --}}
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->created_at }}</td>
                        {{-- <td>{{ $item->slug }}</td> --}}
                        <td>
                            <a href="{{ route('get_admin.department.update', $item->id) }}" class="btn btn-info"
                                style="padding: 5px">Edit</a>
                            {{-- <a href="#">|</a> --}}
                            <a href="{{ route('get_admin.department.delete', $item->id) }}" class="btn btn-danger"
                                style="padding: 5px">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
