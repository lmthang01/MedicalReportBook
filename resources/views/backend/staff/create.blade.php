@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Thêm mới (Nhân viên)</h2>
        <a href="{{ route('get_admin.staff.index') }}" class="btn btn-dark">Trở về</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('backend.staff.form')
        </div>
    </div>
@stop
