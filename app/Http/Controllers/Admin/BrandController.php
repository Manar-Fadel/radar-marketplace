<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Managers\AdminManager;
use App\Models\Brand;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $brands = Brand::query()->orderBy('id', 'DESC')->paginate(21);

        return view('cpanel.brand.index', ['brands' => $brands]);
    }
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (empty($request->get('name_ar')) || empty($request->get('name_en'))) {
            Session::flash('error', 'Pleas Fill Data Correctly');

            return redirect()->back();
        }

        $model = new Brand;
        $model->brand_name_ar = $request->get('name_ar');
        $model->brand_name_en = $request->get('name_en');
        if ($request->has('image')) {
            $file = $request->file('image');
            $image_name = AdminManager::uploadImageFile($file, 'brands/');
            $model->logo_url = $image_name;
        }

        if ($model->save()) {
            Session::flash('message', 'Data added successfully');
        } else {
            Session::flash('error', 'Pleas Fill Data Correctly');
        }

        return redirect()->back();
    }
    public function update($id): \Illuminate\Http\RedirectResponse
    {
        $model = Brand::find($id);
        if ($model instanceof Brand) {
            $model->fill(request()->all());
            if ($model->save()) {
                $model->touch();
                Session::flash('success', 'Data updated successfully');
            }
        }

        return redirect()->back();
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $model = Brand::find($id);
        if ($model instanceof Brand) {
            // check there is no orders to this brand,
            $brand_orders_count = Order::where('brand_id', $model->id)->count();
            if ($brand_orders_count > 0) {
                Session::flash('error', "Brand has orders before, shouldn't be deleted");
                return redirect()->back();
            }

            $model->models()->delete();
            if ($model->delete()) {
                Session::flash('message', 'Data deleted successfully');
            }
        }

        return redirect()->back();
    }

}
