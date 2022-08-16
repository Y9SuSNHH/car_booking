<div class="col-lg-6 col-md-6" onclick="modalEachCar('{{$car->id}}')"
     id="btn-modal-each-car-{{$car->id}}" data-toggle="modal" data-target="#modal-each-car">
    <div class="card card-product card-plain" style="box-shadow: 0px 5px 25px 0px rgb(0 0 0 / 20%);">
        <a class="text-decoration-none" data-toggle="modal" data-target="#car-modal">
            <div class="card-image">
                <img class="img rounded w-100" src="{{ asset('storage') . '/'. $car->image}}" style="height:200px">
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    {{Str::limit($car->name, 20, '...')}}
                    <span class="text-success font-weight-bold float-right">{{$car->price_1_day}}K</span>
                </h5>
                <span class="badge badge-default">{{$car->FuelName}}</span>
                <span class="badge badge-success">{{$car->TransmissionName}}</span>
                <br>
                <i class="now-ui-icons location_pin"> {{$car->address2}}</i>
            </div>
        </a>
    </div>
</div>
