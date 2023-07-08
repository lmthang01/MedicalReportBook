@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Quản lý nhân viên</h2>
        <a href="{{ route('get_admin.staff.create') }}" class="btn btn-primary" style="color: azure;">Thêm mới</a>
    </div>
    <form class="form-inline">
        <div class="form-group mb-2 mr-2">
            <label for="inputPassword2" class="sr-only">Tìm tên</label>
            <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}"
                placeholder="Mã nhân viên, Tên ? ">
        </div>

        <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>

    </form>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Mã nhân viên</th>
                    <th>Tên</th>
                    <th>Phòng ban</th>
                    <th>Hộ khẩu thường trú</th>
                    <th>Ngày sinh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs ?? [] as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <img src="{{ pare_url_file($item->avatar) }}"
                                style="width: 60px; height: 60px; border-radius: 10px" alt="">
                        </td>
                        <td>{{ $item->staff_code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->department->name ?? '[N\A]' }}</td>
                        <td>
                            <span> {{ $item->province->name ?? '...' }} -
                                {{ $item->district->name ?? '...' }} -
                                {{ $item->ward->name ?? '...' }}</span>
                            {{-- <br> --}}
                            {{-- {{ $item->address }} --}}
                        </td>
                        <td>{{ $item->birth_date }}</td>
                        <td>
                            <a href="{{ route('get_admin.staff.update', $item->id) }}" class="btn btn-info"
                                style="padding: 5px">Edit</a>
                            <a href="{{ route('get_admin.staff.delete', $item->id) }}" class="btn btn-danger"
                                style="padding: 5px">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Phân trang --}}
    {{-- <div class="pagination">
        {{ $staffs->links() }}
    </div>     --}}
@stop
