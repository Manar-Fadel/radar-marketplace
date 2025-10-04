<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $search_word = $request->input('search_word');

        $brands = Brand::query()
                    ->when(! empty($search_word), function ($query) use ($search_word) {
                        $query->where(function ($query) use ($search_word) {
                            $query->where('brand_name_ar', 'like', '%'.$search_word.'%')
                                ->orWhere('brand_name_en', 'like', '%'.$search_word.'%');
                        });
                    })->orderBy('id', 'DESC')
                    ->get();

        return response()->json([
            'status' => 'true',
            'data' => [
                'brands' => BrandResource::collection($brands)
            ]
        ]);
    }
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:car_brands,name',
            'icon' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('uploads/brands', 'public');
        }

        $brand = Brand::create([
            'name' => $validated['name'],
            'logo_url' => $iconPath,
        ]);

        return response()->json([
            'message' => 'تمت إضافة البراند بنجاح',
            'brand' => $brand
        ], 201);
    }
    public function update(Request $request, $id): JsonResponse
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:car_brands,name,' . $brand->id,
            'icon' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $iconPath = $brand->logo_url;
        if ($request->hasFile('icon')) {
            if ($iconPath && Storage::disk('public')->exists($iconPath)) {
                Storage::disk('public')->delete($iconPath);
            }
            $iconPath = $request->file('icon')->store('uploads/brands', 'public');
        }

        $brand->update([
            'name' => $validated['name'],
            'logo_url' => $iconPath,
        ]);

        return response()->json([
            'message' => 'تم تحديث البراند بنجاح',
            'brand' => $brand
        ]);
    }
    public function destroy($id): JsonResponse
    {
        $brand = Brand::findOrFail($id);

        if ($brand->logo_url && Storage::disk('public')->exists($brand->logo_url)) {
            Storage::disk('public')->delete($brand->logo_url);
        }

        $brand->delete();

        return response()->json(['message' => 'تم حذف البراند بنجاح']);
    }
}
