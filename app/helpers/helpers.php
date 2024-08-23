<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

define('LANGUAGES', [
    ['name' => 'english', 'code' => 'en'],
    ['name' => 'arabic', 'code' => 'ar'],
]);

if (!function_exists('uploadFile')) {
    function uploadFile($folder_name, $file, $old_file = null)
    {
        $filePath = public_path('storage/' . $folder_name);
        if (!File::exists($filePath)) {
            File::makeDirectory($filePath, 0777, true);
        }
        $name = uniqid() . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($folder_name, $name, 'public');

        if (!is_null($old_file)) {
            Storage::delete('public/' . $old_file);
        }
        return $folder_name . '/' . $name;
    }
}

if (!function_exists('getRandomeColorString')) {
    function getRandomeColorString()
    {
        $colors = ['green','blue','red'];
        return Arr::random($colors);
    }
}

