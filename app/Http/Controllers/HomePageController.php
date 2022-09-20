<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\FindRequest;
use App\Models\Car;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function welcome(): Factory|View|Application
    {
        $cities = Car::query()->clone()
            ->groupBy('city')
            ->pluck('city');

        return view('welcome', [
            'cities' => $cities,
        ]);
    }

    public function index(FindRequest $request): Factory|View|Application
    {
        $city       = $request->get('city');
        $date_start = date('Y-m-d', strtotime($request->get('date_start')));
        $date_end   = date('Y-m-d', strtotime($request->get('date_end')));

        $query = Car::query()->clone();
        if (!empty($city) && $city !== 'All') {
            $query->where('city', $city);
        }

        $query->whereDoesntHave('bills', function ($query) use ($date_start, $date_end) {
            $query->where(function ($q) use ($date_start, $date_end) {
                $q->orwhereRaw("date_start BETWEEN CAST('$date_start'  AS DATE) AND  CAST('$date_end' AS DATE)");
                $q->orwhereRaw("date_end   BETWEEN  CAST('$date_start' AS DATE) AND CAST('$date_end' AS DATE)");
            });
        });
        $cars   = $query->latest()->paginate(9);
        $cities = Car::query()->clone()
            ->groupBy('city')
            ->pluck('city');

        $session['find_cars'] = [
            'city'       => $city,
            'date_start' => $request->get('date_start'),
            'date_end'   => $request->get('date_end'),
        ];
//        dd($session['find_cars']);


        session($session);

        return view('index', [
            'cars'   => $cars,
            'cities' => $cities,
        ]);
    }
}
