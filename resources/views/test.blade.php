@if ($user->files()->exists())
    <div class="form-row">
        <div class="form-group col-xl-6">
            <div class="row">
                <div class="col">
                    <label class="float-left">CCCD</label>
                    <input type="checkbox" name="identity_status" id="identity_status" checked
                           data-switch="success"
                           class="switch-user-file-status"/>
                    <label class="float-left" for="identity_status" data-on-label="Duyệt"
                           data-off-label="Chưa duyệt"></label>
                </div>
            </div>
            <div class="row">
                @foreach($user->files as $file)
                    @if($file->type === App\Enums\FileTypeEnum::IDENTITY_FRONT)
                        <div class="col-sm-6">
                            <h6>Mặt trước</h6>
                            <img name="ole_identity_front"
                                 src="{{asset('storage').'/'. $file->link}}"
                                 style="max-height: 250px; max-width: 250px;">
                        </div>
                    @elseif($file->type === App\Enums\FileTypeEnum::IDENTITY_BACK)
                        <div class="col-sm-6">
                            <h6>Mặt sau</h6>
                            <img name="ole_identity_back"
                                 src="{{asset('storage').'/'. $file->link}}"
                                 style="max-height: 250px; max-width: 250px;">
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h6>Đổi ảnh mới</h6>
                    <input type="file" name="files[IDENTITY_FRONT]" class="form-control-file"
                           oninput="pic1.src=window.URL.createObjectURL(this.files[0])">
                    <img id="pic1" style="max-width: 200px; max-height:200px;"/>
                </div>
                <div class="col-sm-6">
                    <h6>Đổi ảnh mới</h6>
                    <input type="file" name="files[IDENTITY_BACK]" class="form-control-file"
                           oninput="pic2.src=window.URL.createObjectURL(this.files[0])">
                    <img id="pic2" style="max-width: 200px; max-height:200px;"/>
                </div>
            </div>
        </div>
        <div class="form-group col-xl-6">
            <div class="row">
                <div class="col">
                    <label class="float-left">GPLX</label>
                    <input type="checkbox" name="license_car_status" id="license_car_status"
                           checked data-switch="success"
                           class="switch-user-file-status"/>
                    <label class="float-left" for="license_car_status" data-on-label="Duyệt"
                           data-off-label="Chưa duyệt"></label>
                </div>
            </div>
            <div class="row">
                @foreach($user->files as $file)
                    @if($file->type === App\Enums\FileTypeEnum::LICENSE_CAR_FRONT)
                        <div class="col-sm-6">
                            <h6>Mặt trước</h6>
                            <img name="ole_license_car_front"
                                 src="{{asset('storage').'/'. $file->link}}"
                                 style="max-height: 250px; max-width: 250px;">
                        </div>
                    @elseif($file->type === App\Enums\FileTypeEnum::LICENSE_CAR_BACK)
                        <div class="col-sm-6">
                            <h6>Mặt sau</h6>
                            <img name="ole_license_car_back"
                                 src="{{asset('storage').'/'. $file->link}}"
                                 style="max-height: 250px; max-width: 250px;">
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h6>Đổi ảnh mới</h6>
                    <input type="file" name="files[LICENSE_CAR_FRONT]"
                           class="form-control-file"
                           oninput="pic3.src=window.URL.createObjectURL(this.files[0])">
                    <img id="pic3" style="max-width: 200px; max-height:200px;"/>
                </div>
                <div class="col-sm-6">
                    <h6>Đổi ảnh mới</h6>
                    <input type="file" name="files[LICENSE_CAR_BACK]" class="form-control-file"
                           oninput="pic4.src=window.URL.createObjectURL(this.files[0])">
                    <img id="pic4" style="max-width: 200px; max-height:200px;"/>
                </div>
            </div>
        </div>
    </div>
@endif
