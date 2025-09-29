<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Managers\AdminManager;
use App\Managers\Constants;
use App\Managers\ExcelManager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DealerController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $status = $request->get('status');
        $cp_status = $request->get('cp_status');
        $search_word = $request->get('search_word');

        $stat_user_type = $request->get('stat_user_type');
        $stat_start_date = $request->get('stat_start_date');
        $stat_to_date = $request->get('stat_to_date');

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


        if (!is_null($stat_user_type) && !is_null($stat_start_date) && !is_null($stat_to_date)) {
            $stat_start_date = Carbon::parse($stat_start_date)->startOfDay();
            $stat_to_date = Carbon::parse($stat_to_date)->startOfDay();
            $models = User::where('created_at', '>=', $stat_start_date)
                ->whereDate('created_at', '<=', $stat_to_date)
                ->where('type', $stat_user_type);
        }else{
            $models = User::when(!is_null($from_date) && !is_null($to_date), function ($query) use ($from_date, $to_date) {
                $query->where('created_at', '>=', $from_date)
                    ->whereDate('created_at', '<=', $to_date);
            })->where('type', Constants::SELLER);
        }

        $models = $models->when(! empty($status), function ($query) use ($status) {
                $query->where('status', $status);
            })->when(! empty($cp_status), function ($query) use ($cp_status) {
                $query->where('controlpanel_status', $cp_status);

            })->when(! empty($search_word), function ($query) use ($search_word) {
                $query->where(function ($query) use ($search_word) {
                    $query->where('first_name', 'like', '%'.$search_word.'%')
                        ->orWhere('last_name', 'like', '%'.$search_word.'%')
                        ->orWhere('user_name', 'like', '%'.$search_word.'%')
                        ->orWhere('store_name', 'like', '%'.$search_word.'%')
                        ->orWhere('mobile', 'like', '%'.$search_word.'%');
                });
            })->orderBy('id', 'DESC');

        if ($request->get("action") !== null && $request->get("action") == "export") {
            $models = $models->get();
            if (count($models) <= 0){
                return redirect()->back();
            }

            ExcelManager::exportSellers($models);
            return redirect()->back();
        }else{
            $models = $models->paginate(9);
            return view('cpanel.seller.index', [
                'sellers' => $models,
                'models_count' => $models->total(),
                'countries' => SettingsManager::getCountriesAsArray(),
                'brands' => AdminManager::getBrandsAsArray(),
                'cities' => AdminManager::getCitiesAsArray(),
                'years' => Constants::YEARS_LIST,
                'months' => Constants::MONTHS_LIST,
                'weeks' => Constants::WEEKS_LIST
            ]);
        }
    }

    public function activate($id): \Illuminate\Http\RedirectResponse
    {
        $model = User::find($id);
        if ($model instanceof User) {
            $model->controlpanel_status = Constants::ACTIVE;
            $model->save();
        }

        return redirect()->back();
    }
    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $user = User::find($id);
        if ($user instanceof User) {
            $user->mobile = "D".substr($user->id, 0, 2)."_".$user->mobile;
            if (!empty($user->email)) {
                $user->email = "D-" . $user->id . "_" . $user->email;
            }
            $user->save();
            $user->delete();
        }

        return redirect()->back();
    }

    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $model = User::find($id);
        if ($model instanceof User) {
            return view('cpanel.seller.view', [
                'model' => $model,
                'years' => Constants::YEARS_LIST,
                'months' => Constants::MONTHS_LIST,
                'weeks' => Constants::WEEKS_LIST,
                'offer_statuses' => OfferStatus::cases(),
            ]);
        }

        return redirect()->back();
    }


}
