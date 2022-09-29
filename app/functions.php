<?php
if (!function_exists('user')) {
    function user(): ?object
    {
        return auth()->user();
    }
}
if (!function_exists('checkFindCars')) {
    function checkFindCars(): bool
    {
        return session()->get('find_cars') !== null;
    }
}
