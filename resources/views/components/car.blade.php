<div class="col-lg-6 col-md-6">
    <div class="card card-blog">
        <div class="card-image">
            <img class="img rounded" src="{{ asset('storage') . '/'. $car->image}} ">
        </div>
        <div class="card-body">
            <h5 class="card-title">
                {{$car->id}}
            </h5>
            <h6 class="category text-primary">Features</h6>
            <p class="card-description">
                As near as we can tell, this guy must have thought he was going over
                backwards and tapped the rear...
            </p>
        </div>
    </div>
</div>
