<?php

use Illuminate\Support\Facades\Auth;

function removeSession($session) {
    if (\Session::has($session)) {
        \Session::forget($session);
    }
    return true;
}

function randomString($length, $type = 'token') {
    if ($type == 'password')
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    elseif ($type == 'username')
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    else
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $token = substr(str_shuffle($chars), 0, $length);
    return $token;
}

function activeRoute($route): string {
    return request()->routeIs($route) ? 'active' : '';
}

function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function getImage($mime_type = 'default') {
    $img = '/images/icons/' . $mime_type . '.svg';
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $img)) {
        $img = '/images/icons/default.svg';
    }

    return $img;
}

function checkAllowUpload($fileSize) {
    $files = Auth::user()
        ->repositories()
        ->with('files')
        ->get()
        ->flatMap(function ($repository) {
            return $repository->files;
        });
    $storageFree = Auth::user()->storage - $files->sum('size');

    return $fileSize < $storageFree;
}
