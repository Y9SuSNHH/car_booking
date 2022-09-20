<?php

namespace App\Http\Controllers\User;

use App\Enums\BillStatusEnum;
use App\Enums\FileStatusEnum;
use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\User\StoreRequest;
use App\Models\Bill;
use App\Models\Car;
use App\Models\File;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        return view('user.bills.index');
    }

    public function store(StoreRequest $request, $carId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $date_start = strtotime(session()->get('find_cars.date_start'));
            $date_end   = strtotime(session()->get('find_cars.date_end'));
            $diff       = (int)(($date_end - $date_start) / 86400);
            $date_start = date('Y-m-d', $date_start);
            $date_end   = date('Y-m-d', $date_end);

            $car         = Car::query()->find($carId);
            $total_price = ($car->price_1_day + $car->price_insure + $car->price_service) * $diff;
            if (auth()->user()->role === UserRoleEnum::USER) {
                $checkUserIdentity   = (new File)->checkUserIdentity(auth()->user()->id);
                $checkUserLicenseCar = (new File)->checkUserLicenseCar(auth()->user()->id);
                $user['phone']       = auth()->user()->phone;
                $id                  = auth()->user()->id;
                if (!$checkUserIdentity && !$checkUserLicenseCar && empty($user['phone'])) {
                    return $this->errorResponse('Chưa điền đủ thông tin');
                }
            } else if (auth()->user()->role === UserRoleEnum::ADMIN) {
                $data  = $request->validated();
                $files = $data['files'];
                $keys  = array_keys($files);

                $data   = Arr::except($data, ['files']);
                $user   = User::create($data);
                $id     = $user->id;
                $status = FileStatusEnum::PENDING;
                if (auth()->user()->role === UserRoleEnum::ADMIN) {
                    $status = FileStatusEnum::APPROVED;
                }
                foreach ($keys as $key => $value) {
                    $type = FileTypeEnum::getValue($value);
                    (new \App\Models\File)->updateOrCreate(FileTableEnum::USERS, $id, $type, $files[$value], $status);
                }
            }
            $bill = Bill::create([
                "user_id"     => $id,
                "car_id"      => $carId,
                "date_start"  => $date_start,
                "date_end"    => $date_end,
                "total_price" => $total_price,
                "status"      => BillStatusEnum::PENDING,
            ]);
            DB::commit();
            return $this->successResponse($bill->id);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show($billId): Factory|\Illuminate\Contracts\View\View|Application
    {
        $query = Bill::query()
            ->where('id', $billId);

        $query->with('car');

        $bill = $query->get();
        return view('user.bills.show', [
            'bills' => $bill,
        ]);
    }
}
