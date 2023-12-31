@extends('backend.layouts.app_backend')
@section('content')
<h2>Tổng quan</h2>

<div class="row">
    <div class="col-sm-4">
        <div class="box p-3 mb-2 bg-primary text-white">
            <h6>Danh mục <b>20+</b></h6>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box p-3 mb-2 bg-danger text-white">
            <h6>Khách hàng <b>100+</b></h6>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box p-3 mb-2 bg-info text-white">
            <h6>User mới<b>100+</b></h6>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-6">
        <h2>Thành viên mới</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Active</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users ?? [] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>

                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <span class="{{ $item->getStatus($item->status)['class'] ?? 'badge badge-light' }}">
                                    {{ $item->getStatus($item->status)['name'] ?? 'Tạm dừng' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <h2>Khách hàng mới</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Danh mục</th>
                        <th>Người tạo</th>
                        {{-- <th>Giá</th> --}}
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers ?? [] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name ?? '[N\A]' }}</td>
                            <td>{{ $item->user->name ?? '[N\A]' }}</td>
                            {{-- <td>{{ number_format($item->price, 0, ',', '.') }}đ</td> --}}
                            <td>
                                <span class="{{ $item->getStatus($item->status)['class'] ?? 'badge badge-light' }}">
                                    {{ $item->getStatus($item->status)['name'] ?? 'Tạm dừng' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop