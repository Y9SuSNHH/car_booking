<link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/app-modern.min.css')}}" rel="stylesheet" type="text/css" id="light-style" disabled="disabled">
<link href="{{asset('css/app-modern-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#full-width-modal">Full width Modal
</button>
<div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <div class="modal-dialog modal-full-width" role="document">
            <div class="modal-content bg-transparent text-dark">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <div id="carouselExampleIndicators" class="carousel slide"
                                         data-ride="carousel">
                                        <ol class="carousel-indicators">
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                        </div>
                                        <a class="carousel-control-prev"
                                           href="#carouselExampleIndicators"
                                           role="button" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                          aria-hidden="true"></span>
                                            <span class="sr-only">Sau</span>
                                        </a>
                                        <a class="carousel-control-next"
                                           href="#carouselExampleIndicators"
                                           role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                          aria-hidden="true"></span>
                                            <span class="sr-only">Trước</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8 ml-auto mr-auto price_1_day">
                                            <h3 class="text-center">
                                                <span class="text-success font-weight-bold">1234K</span>
                                                <small class="text-muted">/ngày</small>
                                            </h3>
                                        </div>
                                        <div class="col-12 ml-auto mr-auto">
                                            <label for="date_start" class="font-weight-bold">Ngày bắt đầu</label>
                                            <input type="date" name="date_start" id="date_start"
                                                   min="{{now()->addDays()->toDateString()}}"
                                                   class="form-control" value="{{session()->get('date_start')}}">
                                        </div>
                                        <div class="col-12 ml-auto mr-auto">
                                            <label for="date_end" class="font-weight-bold">Ngày kết thúc</label>
                                            <input type="date" name="date_end" id="date_end"
                                                   min="{{now()->addDays(2)->toDateString()}}"
                                                   class="form-control" value="{{session()->get('date_end')}}">
                                        </div>
                                        <br>
                                        <div class="col-12 ml-auto mr-auto mt-2 ">
                                            <div class="alert alert-warning show mb-0">
                                        <span>
                                            <span>Thời gian nhận xe</span>
                                            <span class="float-right">05:00-22:00</span>
                                        </span>
                                                <span>
                                            <span>Thời gian trả xe</span>
                                            <span class="float-right">17:00-21:00</span>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-12 ml-auto mr-auto">
                                            <strong>Địa điểm nhận xe</strong>
                                            <h6>
                                                <i class="now-ui-icons location_compass-05"> Quận Ba Đình</i>
                                            </h6>
                                            <small class="text-muted">Không hỗ trợ giao nhận xe tận nơi. Địa chỉ cụ thể
                                                sẽ được
                                                hiển thị sau khi đặt cọc</small>
                                        </div>
                                        <div class="col-12 ml-auto mr-auto">
                                            <strong>Giới hạn số km</strong><br>
                                            <span>
                                        Tối đa <strong>350</strong> km/ngày. Phí <strong>2K</strong>/km vượt giới hạn.
                                    </span>
                                        </div>
                                        <div class="col-8 ml-auto mr-auto">
                                            <form id="form-each-car" class="col-12">
                                                <div class="text-center">
                                                    <button class="btn btn-success justify-content-center">ĐẶT XE
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal-content -->
<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
