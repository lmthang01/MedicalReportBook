@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Quản lý nhân viên</h2>
        <a href="{{ route('get_admin.staff.create') }}" class="btn btn-primary" style="color: azure;">Thêm mới</a>
    </div>
    <form class="form-inline">
        <div class="form-group mb-2 mr-2">
            <label for="" class="sr-only">Tìm tên</label>
            <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}"
                placeholder="Tên nhân viên ? ">
        </div>

        <div class="form-group mb-2 mr-2">
            <label for="" class="sr-only">Phòng ban</label>
            <select name="department" class="form-control" id="">
                <option value="">-- Tìm phòng ban --</option>
                @foreach ($departments ?? [] as $key => $item)
                    <option value="{{ $item['id'] }}" {{ (Request::get('department') ?? '') == $item['id'] ? 'selected' : '' }}>
                        {{ $item['name'] }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>

    </form>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Avatar</th>
                    {{-- <th>Mã nhân viên</th> --}}
                    <th>Họ và Tên</th>
                    <th>Chức vụ</th>
                    <th>CCCD</th>
                    <th>Phòng ban</th>
                    <th>Số điện thoại</th>
                    {{-- <th>Hộ khẩu thường trú</th> --}}
                    {{-- <th>Ngày sinh</th> --}}
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs ?? [] as $item)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>
                            <img src="{{ pare_url_file($item->avatar) }}"
                                style="width: 60px; height: 60px; border-radius: 10px" alt="">
                        </td>
                        {{-- <td>{{ $item->staff_code }}</td> --}}
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->position }}</td>
                        <td>{{ $item->identity_number }}</td>
                        <td>{{ $item->department->name ?? '[N\A]' }}</td>
                        <td>{{ $item->phone }}</td>

                        {{-- <td>
                            <span> {{ $item->province->name ?? '...' }} -
                                {{ $item->district->name ?? '...' }} -
                                {{ $item->ward->name ?? '...' }}</span>
                            <br>
                            {{ $item->address }}
                        </td> --}}
                        {{-- <td>{{ $item->birth_date }}</td> --}}
                        <td>
                            <a href="{{ route('get_admin.staff.update', $item->id) }}" class="btn btn-info"
                                style="padding: 5px">Edit</a>
                            <a href="{{ route('get_admin.staff.delete', $item->id) }}" class="btn btn-danger"
                                style="padding: 5px" id="delete_alert" >Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $staffs->links() }}
@stop
