<div class="col-lg-4 mt-1 mb-1" onclick="modalEachCar('{{$car->id}}')" data-toggle="modal" data-target="#modal-each-car">
    <div class="card card-blog" style="box-shadow: 0px 5px 25px 0px rgb(0 0 0 / 20%);">
        <div class="card-image">
            <img class="img img-raised" src="{{ asset('storage') . '/'. $car->image}}">
        </div>
        <div class="card-body">
            <h6 class="card-category text-success">
                <i class="mdi mdi-cash-usd-outline" aria-hidden="true"></i> {{$car->price_1_day/1000}}K
            </h6>
            <h6 class="card-title">
                {{Str::limit($car->name , 24, '...')}}
            </h6>
            <p class="card-description">
                @if($car->fuel === 0)
                    <span class="badge badge-success">{{$car->FuelName}}</span>
                @else
                    <span class="badge badge-secondary">{{$car->FuelName}}</span>
                @endif
                @if($car->transmission === 0)
                    <span class="badge badge-info">{{$car->TransmissionName}}</span>
                @else
                    <span class="badge badge-dark">{{$car->TransmissionName}}</span>
                @endif
            </p>
            <hr>
            <div class="card-footer">
                <div class="author small">
                    <i class="dripicons-location" aria-hidden="true"></i> {{$car->district}}
                </div>
            </div>
        </div>
    </div>
</div>
