<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function welcome(): Factory|View|Application
    {
        $addressCars = Car::query()->clone()
            ->groupBy('address')
            ->pluck('address');

        return view('welcome', [
            'addressCars' => $addressCars,
        ]);
    }

    public function index(Request $request): Factory|View|Application
    {
        $session['filter_car'] = [
            'address'    => $request->get('address'),
            'date_start' => $request->get('date_start'),
            'date_end'   => $request->get('date_end'),
        ];
        session($session);

        $address    = $request->get('address');
        $date_start = date('Y-m-d', strtotime($request->get('date_start')));
        $date_end   = date('Y-m-d', strtotime($request->get('date_end')));

        $cars = Car::query()->clone()
            ->where('address', $address)
            ->whereDoesntHave('bills', function ($query) use ($date_start, $date_end) {
                $query->where(function ($q) use ($date_start, $date_end) {
                    $q->orwhereRaw("date_start BETWEEN CAST('$date_start'  AS DATE) AND  CAST('$date_end' AS DATE)");
                    $q->orwhereRaw("date_end   BETWEEN  CAST('$date_start' AS DATE) AND CAST('$date_end' AS DATE)");
                });
            })->paginate(9);

        $addressCars = Car::query()->clone()
            ->groupBy('address')
            ->pluck('address');

        return view('index', [
            'cars'        => $cars,
            'addressCars' => $addressCars,
        ]);
    }
}
