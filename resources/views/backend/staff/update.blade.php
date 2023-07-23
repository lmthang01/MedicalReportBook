@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Cập nhật (Nhân viên)</h2>
        <a href="{{ route('get_admin.staff.index') }}" class="btn btn-dark">Trở về</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('backend.staff.form')
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <h2>Tiền sử bản thân</h2>
        <a href="#" class="btn btn-primary" style="color: azure;" data-toggle="modal" data-target="#ModalCreate">Thêm
            mới</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên bệnh</th>
                        <th>Năm phát hiện</th>
                        <th>Tên bệnh nghề nghiệp</th>
                        <th>Năm phát hiện</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personalHistory ?? [] as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name_of_disease }}</td>
                            <td>{{ $item->detect_year_1 }}</td>
                            <td>{{ $item->occupational_disease_name }}</td>
                            <td>{{ $item->detect_year_2 }}</td>
                            <td>
                                <a href="#" class="btn btn-info" style="padding: 5px" data-toggle="modal"
                                    data-target="#ModalUpdate{{$item->id}}">Edit</a>

                                <a href="{{ route('get_admin.model.delete', $item->id) }}" class="btn btn-danger"
                                    style="padding: 5px" id="delete_alert">Delete</a>
                            </td>
                            @include('backend.staff.model.update')

                        </tr>
                    @endforeach
            </table>
        </div>
    </div>

    @include('backend.staff.model.create')
    {{-- @include('backend.staff.model.update') --}}
@stop
