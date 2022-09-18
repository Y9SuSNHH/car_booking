<?php

namespace App\Http\Controllers\User;

use App\Enums\BillStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Models\Bill;
use App\Models\Car;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;

class BillController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        return view('user.bill.index');
    }

    public function store($carId): JsonResponse
    {
        $car = Car::query()->find($carId);

        $checkUserIdentity   = (new File)->checkUserIdentity(auth()->user()->id);
        $checkUserLicenseCar = (new File)->checkUserLicenseCar(auth()->user()->id);

        $date_start = strtotime(session()->get('find_cars.date_start'));
        $date_end   = strtotime(session()->get('find_cars.date_end'));
        $diff       = (int)(($date_end - $date_start) / 86400);
        $date_start = date('Y-m-d', $date_start);
        $date_end   = date('Y-m-d', $date_end);

        $total_price = ($car->price_1_day + $car->price_insure + $car->price_service) * $diff;

        $user['phone']    = auth()->user()->phone;
        $user['address']  = auth()->user()->address;
        $user['address2'] = auth()->user()->address2;

        if ($checkUserIdentity && $checkUserLicenseCar && !empty($user['phone']) && !empty($user['address']) && !empty($user['address2'])) {
            $bill = Bill::create([
                "user_id"     => auth()->user()->id,
                "car_id"      => $carId,
                "date_start"  => $date_start,
                "date_end"    => $date_end,
                "total_price" => $total_price,
                "status"      => BillStatusEnum::PENDING,
            ]);
        } else {
            return $this->errorResponse('Chưa điền đủ thông tin');
        }
        return $this->successResponse($bill->id);
    }

    public function show($billId): Factory|\Illuminate\Contracts\View\View|Application
    {
        $query = Bill::query()
            ->where('id', $billId);

        $query->with('car');

        $bill = $query->get();
        return view('user.bill.show', [
            'bill' => $bill,
        ]);
    }
}
