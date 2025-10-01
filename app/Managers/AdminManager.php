<?php

namespace App\Managers;

use App\Models\Brand;
use App\Models\City;
use Illuminate\Support\Facades\Storage;

class AdminManager
{
    public static function getBrandsAsArray()
    {
        return Brand::where('is_deleted', 0)->orderBy('id', 'ASC')->get();
    }
    public static function getCitiesAsArray()
    {
        return City::where('is_deleted', 0)->orderBy('id', 'ASC')->get();
    }

    public static function uploadImageFile($file, $folder_name)
    {
        return $file->storeAs($folder_name . date('Y-m'), time() . '.' . $file->getClientOriginalExtension(), 'public');
    }



}
