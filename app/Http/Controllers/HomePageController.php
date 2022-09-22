<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\Car\FindRequest;
use App\Models\Car;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

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

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function index(Request $request): Factory|View|Application
    {
        $city       = session()->get('find_cars.city');
        $date_start = date('Y-m-d', strtotime(session()->get('find_cars.date_start')));
        $date_end   = date('Y-m-d', strtotime(session()->get('find_cars.date_end')));

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

        return view('index', [
            'cars'   => $cars,
            'cities' => $cities,
        ]);
    }
}
