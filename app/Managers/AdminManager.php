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
    public static function uploadImageFile($file, $folder_name, $prefix = 'brand-'): string
    {
        $safeName = $prefix.time().'.'.$file->getClientOriginalExtension();

        $disk = Storage::disk('s3');
        $disk->put($folder_name.$safeName, file_get_contents($file), 'public');

        return $disk->url($folder_name.$safeName);
    }



}
