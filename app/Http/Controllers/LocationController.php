<?php

namespace App\Http\Controllers;

use App\Models\CityModel;
use App\Models\DistrictModel;
use App\Models\SubDistrictModel;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function cities($prov_id)
    {
        $city = CityModel::where('prov_id', $prov_id)->get();

        return response()->json($city);
    }

    public function districts($city_id)
    {
        $districts = DistrictModel::where('city_id', $city_id)->get();

        return response()->json($districts);
    }

    public function subdistricts($dis_id)
    {
        $subdistricts = SubDistrictModel::where('dis_id', $dis_id)->get();

        return response()->json($subdistricts);
    }
}
