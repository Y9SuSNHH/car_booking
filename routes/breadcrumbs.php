<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', static function ($trail) {
    $trail->push('Trang chủ', route('admin.welcome'));
});

// Home > User
Breadcrumbs::for('user', static function ($trail) {
    $trail->parent('home');
    $trail->push('Quản lý người dùng', route('admin.users.index'));
});

// Home > User > Edit
Breadcrumbs::for('user.edit', static function ($trail) {
    $trail->parent('user');
    $trail->push('Sửa');
});

// Home > Car
Breadcrumbs::for('car', static function ($trail) {
    $trail->parent('home');
    $trail->push('Quản lý xe', route('admin.cars.index'));
});
// Home > Car > Edit
Breadcrumbs::for('car.edit', static function ($trail) {
    $trail->parent('car');
    $trail->push('Sửa');
});

// Home > Bill
Breadcrumbs::for('bills', static function ($trail) {
    $trail->parent('home');
    $trail->push('Quản lý hóa đơn', route('admin.bills.index'));
});

// Home > Bill > Show
Breadcrumbs::for('bills.show', static function ($trail) {
    $trail->parent('bills');
    $trail->push('Xem');
});
