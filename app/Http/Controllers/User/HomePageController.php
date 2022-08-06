<?php

namespace App\Http\Controllers\User;

use App\Enums\CarStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Car;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $date_start = date('Y-m-d', strtotime(session()->get('date_start')));
        //lấy ra xe đang được thuê (cần được a long giải cứu)
        // vẫn bị lặp car_id cần along lấy ra car_id mới nhất những cái bị lặp
        $filter     = Bill::query()
            ->where('date_end', '>', $date_start)
            ->pluck('car_id');
        //dùng $filter để lấy ra xe đang rảnh
        $list       = Car::query()
            ->where('status','=',CarStatusEnum::READY)
            ->whereNotIn('id', $filter)
            ->get();
        return view('user.index', [
            'list' => $list,
        ]);
    }
}
