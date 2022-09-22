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
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BillController extends Controller
{
    use ResponseTrait;

    private object $model;
    private string $table;
    private string $role;

    public function __construct()
    {
        $this->model = Bill::query();
        $this->table = (new Bill())->getTable();
        $this->role  = strtolower(UserRoleEnum::getKey(auth()->user()->role));

        View::share('title', ucfirst('Quản lý hóa đơn'));
        View::share('table', $this->table);
    }

    public function index(): Factory|ViewAlias|Application
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

                $user['phone'] = auth()->user()->phone;
                $id            = auth()->user()->id;
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
            $bill = $this->model->create([
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

    public function show($billId): JsonResponse
    {
        $query = $this->model->clone();

        $query->with('user')->with('car')->with('files')->with('staffStart')->with('staffEnd');

        $bill = $query->find($billId);

        $date_start = Carbon::parse($bill->date_start);
        $date_end   = Carbon::parse($bill->date_end);
        $date_diff  = $date_start->diffInDays($date_end);

        $bill->setAttribute('generate_status', $bill->GenerateStatus);
        $bill->setAttribute('status_name', $bill->StatusName);
        $bill->setAttribute('date_diff', $date_diff);
        $bill->user->gender = $bill->user->GenderName;

        return $this->successResponse($bill);
    }

}
