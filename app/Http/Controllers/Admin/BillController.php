<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BillStatusEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BillController extends Controller
{
    private object $model;
    private string $table;
    private string $role;

    public function __construct()
    {
        $this->model = Bill::query();
        $this->table = (new Bill())->getTable();
        $this->role  = strtolower(UserRoleEnum::getKey(UserRoleEnum::ADMIN));

        View::share('title', ucfirst('Quản lý hóa đơn'));
        View::share('table', $this->table);
    }

    public function index(Request $request): Factory|ViewAlias|Application
    {
        $filter['name_user'] = $request->get('name_user');
        $filter['name_car']  = $request->get('name_car');
        $filter['status']    = $request->get('status');

        $query = $this->model->clone()->latest();

        $status = BillStatusEnum::getArrayView();
        if (isset($filter['status']) && $filter['status'] !== 'All') {
            if ($filter['status'] === (string)BillStatusEnum::EXPIRES) {
                $query->where('status', BillStatusEnum::ACCEPTED);
                $query->where('date_end', '<', Date('Y-m-d'));
            } else if ($filter['status'] === (string)BillStatusEnum::ACCEPTED) {
                $query->where('status', BillStatusEnum::ACCEPTED);
                $query->where('date_end', '>=', Date('Y-m-d'));
            } else {
                $query->where('status', $filter['status']);
            }
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

    public function show($billId): Factory|ViewAlias|Application
    {
        dd(1);
        return view("$this->role.$this->table.show", [
//            'data' => $data,
        ]);
    }

    public function edit($billId): Factory|ViewAlias|Application
    {
        $query = $this->model->with('user')->with('car')->with('files');
        $data  = $query->find($billId);

        return view("$this->role.$this->table.edit", [
            'data' => $data,
        ]);
    }

    public function destroy($billId): \Illuminate\Http\RedirectResponse
    {
        $this->model->destroy($billId);

        return redirect()->back()->with('bill_message', 'Xóa thành công');
    }
}
