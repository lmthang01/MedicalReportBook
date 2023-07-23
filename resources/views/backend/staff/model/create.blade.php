<form action="{{ route('get_admin.model.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mới tiền sử bản thân</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">

                        <input type="hidden" name="staff_id" placeholder="" class="form-control"
                            value="{{ $staff->id ?? 0 }}">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="col-form-label input-label">Tên bệnh</label>
                                    <input type="text" name="name_of_disease" placeholder="" class="form-control"
                                        value="{{ old('name_of_disease', $personalHistory->name_of_disease ?? '') }}" required>
                                </div>
                                {{-- @error('name_of_disease')
                                    <small id="" class="form-text text-danger">{{ $errors->first('name_of_disease') }}</small>
                                @enderror --}}
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="detect_year_1" class="col-form-label input-label">Phát hiện năm</label>
                                    <input class="form-control" type="date" name="detect_year_1" value=""
                                        id="detect_year_1">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="col-form-label input-label">Tên bệnh nghề
                                        nghiệp</label>
                                    <input type="text" name="occupational_disease_name" placeholder=""
                                        class="form-control" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="detect_year_2" class="col-form-label input-label">Phát hiện năm</label>
                                    <input class="form-control" type="date" name="detect_year_2" value=""
                                        id="detect_year_2">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btn grey btn-outline-secondary"
                            data-dismiss="modal">{{ __('Back') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
