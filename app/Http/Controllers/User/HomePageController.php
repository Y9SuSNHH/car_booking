<?php

namespace App\Http\Controllers\User;

use App\Enums\CarStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Car;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(Request $request): Factory|View|Application
    {
//        dd(session()->get('date_start'));
        $date_start = date('Y-m-d', strtotime(session()->get('date_start')));
        //lấy ra xe đang được thuê (cần được a long giải cứu)
        // vẫn bị lặp car_id cần along lấy ra car_id mới nhất những cái bị lặp
        $filter = Bill::query()->clone()
            ->where('date_end', '>', $date_start)
            ->pluck('car_id');
        //dùng $filter để lấy ra xe đang rảnh

        $cars = Car::query()->clone()
            ->where('status', '=', CarStatusEnum::READY)
            ->whereNotIn('id', $filter)
            ->get();

        $addressCars = Car::query()->clone()
            ->groupBy('address')
            ->pluck('address');

//        dd($addressCar);
        return view('user.index', [
            'cars'        => $cars,
            'addressCars' => $addressCars,
        ]);
    }
}
