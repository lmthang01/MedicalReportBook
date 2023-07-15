<form method="POST" action="" id="alert_form_submit" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Mã nhân viên <code>*</code></label>
                <input type="text" name="staff_code" placeholder="" class="form-control"
                    value="{{ old('staff_code', $staff->staff_code ?? '') }}">
                @error('staff_code')
                    <small id="" class="form-text text-danger">{{ $errors->first('staff_code') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Họ và tên <code>*</code></label>
                <input type="text" name="name" placeholder="" class="form-control"
                    value="{{ old('name', $staff->name ?? '') }}">
                @error('name')
                    <small id="" class="form-text text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="choose_gender" class="col-form-label input-label">Giới tính <code>*</code></label>
                <select name="gender" class="custom-select custom-select-height" id="choose_gender"
                    style="font-size: 14px !important;">
                    <option value="">Chọn giới tính</option>
                    <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}
                        {{ ($staff->gender ?? '') == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}
                        {{ ($staff->gender ?? '') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    <option value="Khác" {{ old('gender') == 'Khác' ? 'selected' : '' }}
                        {{ ($staff->gender ?? '') == 'Khác' ? 'selected' : '' }}>Khác</option>
                </select>
                @error('gender')
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('gender') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phòng ban <code>*</code></label>
                <select name="department_id" class="form-control" id="">
                    <option value="">Chọn phòng ban</option>
                    @foreach ($departments ?? [] as $item)
                        <option value="{{ $item->id }}" {{ old('department_id') == $item->id ? 'selected' : '' }}
                            {{ ($staff->department_id ?? 0) == $item->id ? 'selected' : '' }}>{{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('department_id') }}</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Chức vụ</label>
                <input type="text" name="position" placeholder="" class="form-control"
                    value="{{ old('position', $staff->position ?? '') }}">
                @error('position')
                    <small id="" class="form-text text-danger">{{ $errors->first('position') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ngày sinh</label>
                <input type="date" name="birth_date" placeholder="" class="form-control"
                    value="{{ old('birth_date', $staff->birth_date ?? '') }}">
                @error('birth_date')
                    <small id="" class="form-text text-danger">{{ $errors->first('birth_date') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" name="email" placeholder="" class="form-control"
                    value="{{ old('email', $staff->email ?? '') }}">
                @error('email')
                    <small id="" class="form-text text-danger">{{ $errors->first('email') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Số điện thoại</label>
                <input type="number" name="phone" placeholder="" class="form-control"
                    value="{{ old('phone', $staff->phone ?? '') }}">
                @error('phone')
                    <small id="" class="form-text text-danger">{{ $errors->first('phone') }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                <label for="exampleInputEmail1">Số chứng minh nhân dân</label>
                <input type="number" name="identity_number" placeholder="" class="form-control"
                    value="{{ old('identity_number', $staff->identity_number ?? '') }}">
                @error('identity_number')
                    <small id="" class="form-text text-danger">{{ $errors->first('identity_number') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="dentity_date" class="col-form-label col-form-label input-label">Ngày cấp </label>
                <input class="form-control" type="date" name="dentity_date"
                    value="{{ old('dentity_date', $staff->dentity_date ?? '') }}" id="dentity_date">
                @error('dentity_date')
                    <small id="" class="form-text text-danger">{{ $errors->first('dentity_date') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nơi cấp</label>
                <input type="text" name="dentity_address" placeholder="" class="form-control"
                    value="{{ old('dentity_address', $staff->dentity_address ?? '') }}">
                @error('dentity_address')
                    <small id="" class="form-text text-danger">{{ $errors->first('dentity_address') }}</small>
                @enderror
            </div>

            {{-- <div class="form-group"> --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label input-label" for="exampleInputEmail1">Hộ khẩu thường trú</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label input-label" for="exampleInputEmail1">Tỉnh thành</label>
                        <select name="province_id" class="custom-select-height form-control" id="loadDistrict">
                            <option value="">Chọn</option>
                            @foreach ($provinces ?? [] as $item)
                                <option value="{{ $item->id }}"
                                    {{ ($staff->province_id ?? 0) == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label input-label" for="exampleInputEmail1">Quận huyện</label>
                        <select name="district_id" class="custom-select-height form-control" id="districtsData">
                            <option value="">Chọn</option>
                            @foreach ($activeDistricts ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label input-label" for="exampleInputEmail1">Phường xã</label>
                        <select name="ward_id" class="custom-select-height form-control" id="wardData">
                            <option value="">Chọn</option>
                            @foreach ($activeWards ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label input-label" for="exampleInputEmail1">Nơi ở hiện tại</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label input-label" for="exampleInputEmail1">Tỉnh thành</label>
                        <select name="province_id_current" class="custom-select-height form-control" id="loadDistrict_current">
                            <option value="">Chọn</option>
                            @foreach ($provinces ?? [] as $item)
                                <option value="{{ $item->id }}"
                                    {{ ($staff->province_id ?? 0) == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label input-label" for="exampleInputEmail1">Quận huyện</label>
                        <select name="district_id_current" class="custom-select-height form-control" id="districtsData_current">
                            <option value="">Chọn</option>
                            @foreach ($activeDistricts ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label input-label" for="exampleInputEmail1">Phường xã</label>
                        <select name="ward_id_current" class="custom-select-height form-control" id="wardData_current">
                            <option value="">Chọn</option>
                            @foreach ($activeWards ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div> --}}



            {{-- </div> --}}

            {{-- <div class="form-group">
                <label for="exampleInputEmail1">Hộ khẩu thường trú</label>
                <input type="text" name="place_residence" placeholder="" class="form-control"
                    value="{{ old('place_residence', $staff->place_residence ?? '') }}">
                @error('place_residence')
                    <small id="" class="form-text text-danger">{{ $errors->first('place_residence') }}</small>
                @enderror
            </div> --}}

            <div class="form-group">
                <label for="exampleInputEmail1">Nơi ở hiện tại</label>
                <input type="text" name="current_residence" placeholder="" class="form-control"
                    value="{{ old('current_residence', $staff->current_residence ?? '') }}">
                @error('current_residence')
                    <small id="" class="form-text text-danger">{{ $errors->first('current_residence') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ngày bắt đàu làm việc</label>
                <input type="date" name="date_start_work" placeholder="" class="form-control"
                    value="{{ old('date_start_work', $staff->date_start_work ?? '') }}">
                @error('date_start_work')
                    <small id="" class="form-text text-danger">{{ $errors->first('date_start_work') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hình ảnh</label>
                <input type="file" class="form-control" name="avatar">

                @if (isset($staff->avatar) && $staff->avatar)
                    <img src="{{ pare_url_file($staff->avatar) }}"
                        style="width: 60px; height: 60px; border-radius: 10px; margin-top: 10px" alt="">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
        </div>

    </div>
</form>
