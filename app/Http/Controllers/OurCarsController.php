<?php

namespace App\Http\Controllers;

use App\Models\OurCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OurCarsController extends Controller
{
    public function index($brand_id = null): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $cars = OurCar::query()->paginate(20);
        return view('our-cars.index', compact('cars'));
    }

    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $model = OurCar::find($id);
        if (!$model) {
            return Redirect::back();
        }
        return view('our-cars.view', compact('model'));
    }
}
