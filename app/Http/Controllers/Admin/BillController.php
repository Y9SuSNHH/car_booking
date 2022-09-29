<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BillStatusEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BillController extends Controller
{
    private object $model;
    private string $table;
    private string $role = 'admin';

    public function __construct()
    {
        $this->model = Bill::query();
        $this->table = (new Bill())->getTable();

        View::share('title', ucfirst('Quản lý hóa đơn'));
        View::share('table', $this->table);
        View::share('role', $this->role);
    }

    public function index(Request $request): Factory|ViewAlias|Application
    {
        $filter['name_user'] = $request->get('name_user');
        $filter['name_car']  = $request->get('name_car');
        $filter['status']    = $request->get('status');

        $query = $this->model->clone()->latest();

        $status = BillStatusEnum::getArrayView();
        $status = Arr::except($status, BillStatusEnum::EXPIRES);
        if (isset($filter['status']) && $filter['status'] !== 'All') {
            $query->where('status', $filter['status']);
        }
        if (!empty($filter['name_user']) && $filter['name_user'] !== 'All') {
            $name = $filter['name_user'];
            $query->whereHas('user', function ($q) use ($name) {
                $q->where('users.name', $name);
            });
        } else {
            $query->with('user');
        }
        if (!empty($filter['name_car']) && $filter['name_car'] !== 'All') {
            $name = $filter['name_car'];
            $query->whereHas('car', function ($q) use ($name) {
                $q->where('cars.name', $name);
            });
        } else {
            $query->with('car');
        }
        $nameUsers = User::query()->pluck('name');
        $nameCars  = Car::query()->pluck('name');
        $query->with('car');
        $data = $query->paginate(10);

        return view("$this->role.$this->table.index", [
            'data'      => $data,
            'filter'    => $filter,
            'nameUsers' => $nameUsers,
            'nameCars'  => $nameCars,
            'status'    => $status,
        ]);
    }

    public function show(Request $request, $billId): Factory|ViewAlias|RedirectResponse|Application
    {
        $filter['status'] = $request->get('status');

        $id = $request->get('id');

        $status = BillStatusEnum::getArrayView();
        $status = Arr::except($status, BillStatusEnum::EXPIRES);
        if (isset($filter['status'])) {
            DB::beginTransaction();
            try {
                $bill                = $this->model->find($id);
                $bill->status        = $filter['status'];
                $bill->date_real_end = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                $bill->save();
                DB::commit();
                return redirect()->back()->with('bills_success_message', 'Thay đổi trạng thái thành công');
            } catch (\Throwable $e) {
                DB::rollBack();
                return redirect()->back()->with('bills_error_message', 'Thay đổi trạng thái thất bại');
            }
        }
        return view("$this->role.$this->table.show", [
            'billId' => $billId,
            'status' => $status,
            'filter' => $filter,
        ]);
    }

    public function edit()
    {
        dd(1);
    }

    public function update()
    {
        dd(1);
    }

    public function destroy($id): RedirectResponse
    {
        $bill = $this->model->find($id);
        $bill->delete();
        return redirect()->back()->with('bills_success_message', 'Xóa thành công');
    }
}
