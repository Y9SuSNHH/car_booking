<?php

namespace App\View\Components\Car;

use Illuminate\View\Component;

class Car extends Component
{
    public object $car;
    public function __construct($car)
    {
        $this->car = $car;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.car.list');
    }
}
