@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Quản lý người dùng</h2>
        <a href="{{ route('get_admin.user.create') }}" class="btn btn-primary"  style="color: azure;">Thêm mới</a>
    </div>
    <form class="form-inline">
        <div class="form-group mb-2 mr-2">
            <label for="inputPassword2" class="sr-only">Tìm tên</label>
            <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}"
                placeholder="Tên, email, số điện thoại">
        </div>

        <div class="form-group mb-2 mr-2">
            <label for="inputPassword2" class="sr-only">Trạng thái</label>
            <select name="status" class="form-control" id="">
                <option value="">-- Tìm trạng thái --</option>
                @foreach ($status ?? [] as $key => $item)
                    <option value="{{ $key }}" {{ (Request::get('status') ?? 0) == $key ? 'selected' : '' }}>
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
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Trạng thái</th>
                    <th>Type</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users ?? [] as $item)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>
                            <img src="{{ pare_url_file($item->avatar) }}"
                            style="width: 60px; height: 60px; border-radius: 10px" alt="">
                        </td>  
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>
                            <span class="{{ $item->getStatus($item->status)['class'] ?? "badge badge-light" }}">
                                {{ $item->getStatus($item->status)['name'] ?? "Tạm dừng" }}
                            </span>
                        </td>
                        <td>
                            @if (isset($item->userType) && !$item->userType->isEmpty())
                                @foreach ($item->userType as $type)
                                    <span>{{ $type->name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('get_admin.user.update', $item->id) }}" class="btn btn-info" style="padding: 5px">Edit</a>
                            {{-- <a href="#">|</a> --}}
                            <a href="{{ route('get_admin.user.delete', $item->id) }}" class="btn btn-danger" style="padding: 5px">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
@stop
