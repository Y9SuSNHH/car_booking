<?php

namespace App\Http\Controllers\User;

use App\Enums\Bill\BillStatusEnum;
use App\Enums\CarStatusEnum;
use App\Enums\FileTableEnum;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Car;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class BillController extends Controller
{

    /**
     * @param Request $request
     * @param $carId
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store(Request $request, $carId)
    {
        $checkUserIdentity   = (new File)->checkUserIdentity(auth()->user()->id);
        $checkUserLicenseCar = (new File)->checkUserLicenseCar(auth()->user()->id);

        $date_start          = date('Y-m-d', strtotime(session()->get('filter_car.date_start')));
        $date_end            = date('Y-m-d', strtotime(session()->get('filter_car.date_end')));

        if ($checkUserIdentity && $checkUserLicenseCar) {
            $bill = Bill::create([
                "user_id"     => auth()->user()->id,
                "car_id"      => $carId,
                "date_start"  => $date_start,
                "date_end"    => $date_end,
                "total_price" => $request->get('total_price'),
                "status"      => BillStatusEnum::PENDING,
            ]);
            return redirect()->back()->with('checkUser', 'test');
        }
        return redirect()->back()->with('checkUser', 'Vui lòng nhập đầy đủ thông tin cá nhân');
    }
}
