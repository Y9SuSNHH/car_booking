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
        View::share('role', $this->role);
    }

    public function index(): Factory|ViewAlias|Application
    {
        $query = $this->model->clone()->latest();
        $query->where('user_id',auth()->user()->id);
        $query->with('car');

        $bills = $query->paginate(5);
        return view('user.bills.index', [
            'bills' => $bills,
        ]);
    }

    public function show($billId): Factory|ViewAlias|Application
    {
        return view("$this->role.$this->table.show", [
            'billId' => $billId,
        ]);
    }
}
