<form method="POST" action="" id="alert_form_submit" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-5">
            {{-- <div class="form-group">
                <label for="" class="col-form-label input-label">Mã nhân viên <code>*</code></label>
                <input type="text" name="staff_code" placeholder="" class="form-control"
                    value="{{ old('staff_code', $staff->staff_code ?? '') }}">
                @error('staff_code')
                    <small id="" class="form-text text-danger">{{ $errors->first('staff_code') }}</small>
                @enderror
            </div> --}}
            <div class="form-group">
                <label for="" class="col-form-label input-label">Họ và tên <code>*</code></label>
                <input type="text" name="name" placeholder="" class="form-control"
                    value="{{ old('name', $staff->name ?? '') }}">
                @error('name')
                    <small id="" class="form-text text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="col-form-label input-label">Phòng ban <code>*</code></label>
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
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="choose_gender" class="col-form-label input-label">Giới tính</label>
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
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="col-form-label input-label">Ngày sinh</label>
                        <input type="date" name="birth_date" placeholder="" class="form-control"
                            value="{{ old('birth_date', $staff->birth_date ?? '') }}">
                        @error('birth_date')
                            <small id="" class="form-text text-danger">{{ $errors->first('birth_date') }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="identity_number" class="col-form-label input-label">Số chứng minh
                            nhân dân</label>
                        <input type="number" name="identity_number" placeholder="" class="form-control"
                            value="{{ old('identity_number', $staff->identity_number ?? '') }}">
                        @error('identity_number')
                            <small id=""
                                class="form-text text-danger">{{ $errors->first('identity_number') }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="dentity_date" class="col-form-label input-label">Ngày cấp
                            CMND</label>
                        <input class="form-control" type="date" name="dentity_date"
                            value="{{ old('dentity_date', $staff->dentity_date ?? '') }}" id="dentity_date">
                        @error('dentity_date')
                            <small id=""
                                class="form-text text-danger">{{ $errors->first('dentity_date') }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-form-label input-label">Nơi cấp CMND tại</label>
                <input type="text" name="dentity_address" placeholder="" class="form-control"
                    value="{{ old('dentity_address', $staff->dentity_address ?? '') }}">
                @error('dentity_address')
                    <small id="" class="form-text text-danger">{{ $errors->first('dentity_address') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="col-form-label input-label">Chức vụ</label>
                <input type="text" name="position" placeholder="" class="form-control"
                    value="{{ old('position', $staff->position ?? '') }}">
                @error('position')
                    <small id="" class="form-text text-danger">{{ $errors->first('position') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="col-form-label input-label">Email</label>
                <input type="text" name="email" placeholder="" class="form-control"
                    value="{{ old('email', $staff->email ?? '') }}">
                @error('email')
                    <small id="" class="form-text text-danger">{{ $errors->first('email') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="col-form-label input-label">Số điện thoại</label>
                <input type="number" name="phone" placeholder="" class="form-control"
                    value="{{ old('phone', $staff->phone ?? '') }}">
                @error('phone')
                    <small id="" class="form-text text-danger">{{ $errors->first('phone') }}</small>
                @enderror
            </div>
        </div>
        
        <div class="col-sm-7">
            {{-- Nơi thường trú start --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-form-label input-label">Hộ khẩu thường trú</label>
                        <input type="text" name="place_residence" placeholder="Số nhà" class="form-control"
                            value="{{ old('place_residence', $staff->place_residence ?? '') }}">
                        @error('place_residence')
                            <small id=""
                                class="form-text text-danger">{{ $errors->first('place_residence') }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-form-label input-label">Tỉnh thành</label>
                        <select name="province_id_residence" class="custom-select-height form-control" id="loadDistrict_residence">
                            <option value="">Chọn</option>
                            @foreach ($provinces ?? [] as $item)
                                <option value="{{ $item->id }}"
                                    {{ ($staff->province_id_residence ?? 0) == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-form-label input-label">Quận huyện</label>
                        <select name="district_id_residence" class="custom-select-height form-control" id="districtsData_residence">
                            <option value="">Chọn</option>
                            @foreach ($activeDistricts_residence ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-form-label input-label">Phường xã</label>
                        <select name="ward_id_residence" class="custom-select-height form-control" id="wardData_residence">
                            <option value="">Chọn</option>
                            @foreach ($activeWards_residence ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- Nơi thường trú end --}}
            {{-- Nơi ở hiện tại start --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-form-label input-label">Nơi ở hiện tại</label>
                        <input type="text" name="current_residence" placeholder="Số nhà" class="form-control"
                            value="{{ old('current_residence', $staff->current_residence ?? '') }}">
                        @error('current_residence')
                            <small id=""
                                class="form-text text-danger">{{ $errors->first('current_residence') }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-form-label input-label">Tỉnh thành</label>
                        <select name="province_id_current" class="custom-select-height form-control"
                            id="loadDistrict_current">
                            <option value="">Chọn</option>
                            @foreach ($provinces ?? [] as $item)
                                <option value="{{ $item->id }}"
                                    {{ ($staff->province_id_current ?? 0) == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-form-label input-label">Quận huyện</label>
                        <select name="district_id_current" class="custom-select-height form-control"
                            id="districtsData_current">
                            <option value="">Chọn</option>
                            @foreach ($activeDistricts_current ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="col-form-label input-label">Phường xã</label>
                        <select name="ward_id_current" class="custom-select-height form-control"
                            id="wardData_current">
                            <option value="">Chọn</option>
                            @foreach ($activeWards_current ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- Nơi ở hiện tại end --}}

            <div class="form-group">
                <label for="" class="col-form-label input-label">Nghề nghiệp</label>
                <input type="text" name="career" placeholder="" class="form-control"
                    value="{{ old('career', $staff->career ?? '') }}">
                @error('career')
                    <small id="" class="form-text text-danger">{{ $errors->first('career') }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="" class="col-form-label input-label">Nơi công tác học tập</label>
                <input type="text" name="work_place" placeholder="" class="form-control"
                    value="{{ old('work_place', $staff->work_place ?? '') }}">
                @error('work_place')
                    <small id="" class="form-text text-danger">{{ $errors->first('work_place') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="col-form-label input-label">Ngày bắt đàu làm việc</label>
                <input type="date" name="date_start_work" placeholder="" class="form-control"
                    value="{{ old('date_start_work', $staff->date_start_work ?? '') }}">
                @error('date_start_work')
                    <small id="" class="form-text text-danger">{{ $errors->first('date_start_work') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="col-form-label input-label">Nghề, công việc trước đây</label>
                <textarea name="previous_work" id="" class="form-control"
                    placeholder="Liệt kê các công việc gần đây tính từ thời điểm gần nhất" cols="30" rows="2">{{ old('previous_work', $staff->previous_work ?? '') }}</textarea>
                @error('previous_work')
                    <small id="" class="form-text text-danger">{{ $errors->first('previous_work') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="col-form-label input-label">Tiểu sử bệnh tật của gia đình</label>
                <textarea name="family_medical_history" id="" class="form-control" placeholder="" cols="30"
                    rows="2">{{ old('family_medical_history', $staff->family_medical_history ?? '') }}</textarea>
                @error('family_medical_history')
                    <small id=""
                        class="form-text text-danger">{{ $errors->first('family_medical_history') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="" class="col-form-label input-label">Hình ảnh</label>
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
