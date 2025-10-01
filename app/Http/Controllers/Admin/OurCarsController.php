<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCarRequest;
use App\Managers\AdminManager;
use App\Managers\Constants;
use App\Models\Brand;
use App\Models\OurCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OurCarsController extends Controller
{
    public function index($brand_id = null): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $cars = OurCar::query()->paginate(20);
        $brands = Brand::query()->pluck("brand_name_en", 'id')->toArray();

        return view('cpanel.our-cars.index', compact('cars', 'brands'));
    }

    public function slider($brand_id = null): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $cars = OurCar::where('is_slider_banner', 1)->get();
        $brands = Brand::query()->pluck("brand_name_en", 'id')->toArray();

        return view('cpanel.our-cars.slider', compact(
            'cars', 'brands'
        ));
    }

    public function store(CreateCarRequest $request): \Illuminate\Http\RedirectResponse
    {
        $model = new OurCar();
        $model->price = $request->get('price');
        $model->brand_id = $request->get('brand_id');
        $model->model_id = $request->get('model_id');
        $model->mileage = $request->get('mileage');
        $model->fuel_type = $request->get('fuel_type');
        $model->transmission = $request->get('transmission');
        $model->engine = $request->get('engine');
        $model->drive_type = $request->get('drive_type');
        $model->person =  $request->get('person');
        $model->description_en = $request->get('description_en');
        $model->description_ar = $request->get('description_ar');

        $model->is_slider_banner = ! empty($request->get('is_slider_banner')) && $request->get('is_slider_banner') ? 1 : 0;
        $model->is_best_car = ! empty($request->get('is_best_car')) && $request->get('is_best_car') ? 1 : 0;
        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $image_name = AdminManager::uploadImageFile($file, 'uploads/cars/');
            $model->main_image_url = $image_name;
        }

        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');
            $image_name = AdminManager::uploadImageFile($file, 'uploads/cars/');
            $model->slider_image_url = $image_name;
        }

        if ($model->save()) {
            Session::flash('message', 'Data added successfully');
        } else {
            Session::flash('error', 'Pleas Fill Data Correctly');
        }

        return redirect()->back();
    }

    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $model = OurCar::find($id);
        if (! $model instanceof OurCar) {
            return redirect()->back();
        }

        $brands = Brand::query()->pluck("brand_name_en", 'id')->toArray();
        return view('cpanel.our-cars.edit', [
            'model' => $model,
            'brands' => $brands
        ]);
    }

    public function update($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        if (empty($request->get('title_ar')) || empty($request->get('title_en'))) {
            Session::flash('error', 'Pleas Fill Data Correctly');

            return redirect()->back();
        }

        $model = OurCar::find($id);
        if ($model instanceof OurCar) {
            $model->fill(request()->except('main_image', 'slider_image'));
            $model->is_slider_banner = ! empty($request->get('is_slider_banner')) && $request->get('is_slider_banner') ? 1 : 0;
            $model->is_best_car = ! empty($request->get('is_best_car')) && $request->get('is_best_car') ? 1 : 0;

            if ($request->hasFile('main_image')) {
                $file = $request->file('main_image');
                $image_name = AdminManager::uploadImageFile($file, 'cars/');
                $model->main_image_url = $image_name;
            }

            if ($request->hasFile('slider_image')) {
                $file = $request->file('slider_image');
                $image_name = AdminManager::uploadImageFile($file, 'cars/');
                $model->slider_image_url = $image_name;
            }

            if ($model->save()) {
                Session::flash('message', 'Data updated successfully');
                return redirect()->route('admin.our-cars.index');
            }
        }

        return redirect()->back();
    }

    public function enableAsSliderBanner($id): \Illuminate\Http\RedirectResponse
    {
        $model = OurCar::find($id);
        if (! $model instanceof OurCar) {
            Session::flash('error', 'Data not found');

            return \redirect()->back();
        }
        if (! $model->is_slider_banner) {
            $model->is_slider_banner = 1;
            $model->save();

        } elseif ($model->is_slider_banner) {
            $model->is_slider_banner = 0;
            $model->save();
        }

        Session::flash('message', 'Process done successfully');

        return \redirect()->back();
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $model = OurCar::find($id);
        if ($model instanceof OurCar) {
            $model->images->each->delete();
            if ($model->delete()) {
                Session::flash('message', 'Data deleted successfully');
            }
        }

        return redirect()->back();
    }




}
