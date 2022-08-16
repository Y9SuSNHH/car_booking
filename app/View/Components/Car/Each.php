<?php

namespace App\View\Components\Car;

use Illuminate\View\Component;

class Each extends Component
{
//    public object $each;
    public function __construct()
    {
//        dd($each);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.car.each');
    }
}
