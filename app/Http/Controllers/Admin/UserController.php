<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Managers\Constants;
use App\Managers\ExcelManager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('cpanel.customer.index', [
            'years' => Constants::YEARS_LIST,
            'months' => Constants::MONTHS_LIST,
            'weeks' => Constants::WEEKS_LIST
        ]);
    }
    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $model = User::withTrashed()->find($id);
        if ($model instanceof User) {
            return view('cpanel.customer.view', ['model' => $model]);
        }

        return redirect()->back();
    }
   public function export(Request $request): \Illuminate\Http\RedirectResponse
    {
        $status = $request->get('user_status');
        $cp_status = $request->get('cp_status');
        $search_word = $request->get('search_word');
        $city_id = $request->get('city_id');

        $from_date = null;
        $to_date = null;
        if (!empty($request->get('year')) && !empty($request->get('month'))) {
            $year = $request->get('year');
            $month = $request->get('month');
            if (! empty($request->get('week'))) {
                if ($request->get('week') == 'FIRST_WEEK') {
                    $from_date = Carbon::parse($year.'-'.$month.'-'.'01');
                    $to_date = Carbon::parse($year.'-'.$month.'-'.'07'.' 23:59:59');
                } elseif ($request->get('week') == 'SECOND_WEEK') {
                    $from_date = Carbon::parse($year.'-'.$month.'-'.'07');
                    $to_date = Carbon::parse($year.'-'.$month.'-'.'14'.' 23:59:59');

                } elseif ($request->get('week') == 'THIRD_WEEK') {
                    $from_date = Carbon::parse($year.'-'.$month.'-'.'14');
                    $to_date = Carbon::parse($year.'-'.$month.'-'.'24'.' 23:59:59');

                } elseif ($request->get('week') == 'FOURTH_WEEK') {
                    $from_date = Carbon::parse($year.'-'.$month.'-'.'24');
                    $to_date = Carbon::parse($from_date)->endOfMonth();
                }

            }else{
                $from_date = Carbon::parse($year.'-'.$month.'-'.'01');
                $to_date = Carbon::parse($from_date)->endOfMonth();
            }
        }

        $models = User::when(!is_null($from_date) && !is_null($to_date), function ($query) use ($from_date, $to_date) {
                            $query->where('created_at', '>=', $from_date)
                                ->whereDate('created_at', '<=', $to_date);
                        })
                        ->when(!empty($status), function ($query) use ($status) {
                            $query->where('status', $status);
                        })->when(!empty($cp_status), function ($query) use ($cp_status) {
                            $query->where('controlpanel_status', $cp_status);

                        })->when(!empty($city_id), function ($query) use ($city_id) {
                            $query->where('city_id', $city_id);

                        })->when(!empty($search_word), function ($query) use ($search_word) {
                            $query->where(function ($query) use ($search_word) {
                                $query->where('first_name', 'like', '%' . $search_word . '%')
                                    ->orWhere('last_name', 'like', '%' . $search_word . '%')
                                    ->orWhere('user_name', 'like', '%' . $search_word . '%')
                                    ->orWhere('store_name', 'like', '%' . $search_word . '%')
                                    ->orWhere('mobile', 'like', '%' . $search_word . '%');
                            });
                        })->orderBy('id', 'DESC')
                        ->withTrashed()
                        ->get();

        if (count($models) <= 0){
            return redirect()->back();
        }

        ExcelManager::exportCustomers($models);
        return redirect()->back();
    }

}
