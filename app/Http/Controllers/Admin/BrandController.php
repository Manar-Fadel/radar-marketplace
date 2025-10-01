<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarModelResource;
use App\Managers\AdminManager;
use App\Models\Brand;
use App\Models\CarModel;
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

    public function brandModels($id): \Illuminate\Http\JsonResponse
    {
        $models = CarModel::where('brand_id', $id)->orderBy('model_name_en', 'ASC')->get();
        return response()->json(CarModelResource::collection($models));
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
            $image_name = AdminManager::uploadImageFile($file, 'uploads/brands/');
            $model->logo_url = $image_name;
        }

        if ($model->save()) {
            Session::flash('message', 'Data added successfully');
        } else {
            Session::flash('error', 'Pleas Fill Data Correctly');
        }

        return redirect()->back();
    }

    public function storeModel(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (empty($request->get('brand_id')) || empty($request->get('name_ar')) || empty($request->get('name_en'))) {
            Session::flash('error', 'Pleas Fill Data Correctly');
            return redirect()->back();
        }

        $brand  = Brand::find($request->get('brand_id'));
        if (!$brand instanceof Brand){
            Session::flash('error', 'Brand not found');
        }
        $model = new CarModel();
        $model->brand_id = $request->get('brand_id');
        $model->model_name_ar = $request->get('name_ar');
        $model->model_name_en = $request->get('name_en');
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

    public function deleteModel($id): \Illuminate\Http\RedirectResponse
    {
        $model = CarModel::find($id);
        if ($model instanceof CarModel) {
            $brand = Brand::find($model->brand_id);
            if (!$brand instanceof Brand) {
                Session::flash('error', "Brand not found");
                return redirect()->back();
            }

            if ($model->delete()) {
                Session::flash('message', 'Data deleted successfully');
            }
        }

        return redirect()->back();
    }

}
