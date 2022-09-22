@extends('layout_frontend.master')
@section('content')
    <div class="section section-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto text-center title">
                    <h2>Lịch sử thuê xe</h2>
                </div>
            </div>
            @foreach($bills as $bill)
                <div class="article">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <div class="card card-blog card-plain text-center">
                                <div class="card-image">
                                    <img class="img img-raised" src="{{asset('storage')}}/{{$bill->car->image}}">
                                </div>
                                <div class="card-body">
                                    <div class="card-category">
                                        <span class="label label-{{$bill->GenerateStatus}} main-tag">
                                            {{$bill->StatusName}}
                                        </span>
                                    </div>
                                    <h3 class="card-title">{{$bill->car->name}}</h3>
                                    <h5 class="font-weight-bold">
                                        <span class="text-success">
                                            {{ number_format($bill->total_price) }} đ
{{--                                            {{$bill->total_price}}--}}
                                        </span> | {{$bill->date_start}}
                                    </h5>
                                </div>
                                <a href="{{ route("$role.$table.show",$bill->id)}}"
                                   class="btn btn-round btn-sm">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="ml-auto mr-auto">
                    {{$bills->links()}}
                </div>
            </div>
        </div>

    </div>
@endsection
