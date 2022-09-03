<?php

namespace App\Http\Controllers\User;

use App\Enums\Bill\BillStatusEnum;
use App\Enums\CarStatusEnum;
use App\Enums\FileTableEnum;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Car;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $search['find']['address']    = session()->get('address');
        $search['find']['date_start'] = session()->get('date_start');
        $search['find']['date_end']   = session()->get('date_end');

//        dd($search);
        $address    = session()->get('address');
        $date_start = date('Y-m-d', strtotime(session()->get('date_start')));
        $date_end   = date('Y-m-d', strtotime(session()->get('date_end')));
        $cars       = Car::query()->clone()
            ->where('address', $address)
            ->whereDoesntHave('bills', function ($query) use ($date_start, $date_end, $address) {
                $query->where(function ($q) use ($date_start, $date_end) {
                    $q->orwhereRaw("date_start BETWEEN CAST('$date_start'  AS DATE) AND  CAST('$date_end' AS DATE)");
                    $q->orwhereRaw("date_end   BETWEEN  CAST('$date_start' AS DATE) AND CAST('$date_end' AS DATE)");
                });
            })->paginate(9);

        $addressCars = Car::query()->clone()
            ->groupBy('address')
            ->pluck('address');

//        dd($addressCar);
        return view('user.index', [
            'cars'        => $cars,
            'addressCars' => $addressCars,
        ]);
    }

    public function storeBill(Request $request, $carId)
    {
        $bill = Bill::create([
            "user_id"     => auth()->user()->id,
            "car_id"      => $carId,
            "date_start"  => session()->get('date_start'),
            "date_end"    => session()->get('date_end'),
            "total_price" => $request->get('total_price'),
            "status"      => BillStatusEnum::PENDING,
        ]);
        return redirect()->back();
    }
}
