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
