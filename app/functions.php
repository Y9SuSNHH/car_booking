<?php
if (!function_exists('user')) {
    function user(): ?object
    {
        return auth()->user();
    }
}
