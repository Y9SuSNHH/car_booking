<div class="col-md-4 mt-1 mb-1" onclick="modalEachCar('{{$car->id}}')"
     id="btn-modal-each-car-{{$car->id}}" data-toggle="modal" data-target="#modal-each-car">
    <div class="card card-blog" style="box-shadow: 0px 5px 25px 0px rgb(0 0 0 / 20%);">
        <div class="card-image">
            <a href="#">
                {{--                    <img class="img img-raised" src="{{ asset('storage') . '/'. $car->image}}">--}}
                <img class="img img-raised" src="https://picsum.photos/640/480">
            </a>
        </div>
        <div class="card-body">
            <h6 class="card-category text-success">
                <i class="mdi mdi-cash-usd-outline" aria-hidden="true"></i> {{$car->price_1_day}}K
            </h6>
            <h6 class="card-title">
                {{Str::limit($car->name, 22, '...')}}
            </h6>
            <p class="card-description">
                @if($car->fuel === 0)
                    <span class="badge badge-success">{{$car->FuelName}}</span>
                @else
                    <span class="badge badge-secondary">{{$car->FuelName}}</span>
                @endif
                <span class="badge badge-info">{{$car->TransmissionName}}</span>
            </p>
            <div class="card-footer">
                <div class="stats">
                    <i class="dripicons-location" aria-hidden="true"></i> {{$car->address2}}
                </div>
            </div>
        </div>
    </div>
</div>
