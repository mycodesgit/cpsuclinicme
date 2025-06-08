<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SettingDB\Region;
use App\Models\SettingDB\Province;
use App\Models\SettingDB\City;
use App\Models\SettingDB\Barangay;

class AddressController extends Controller
{
    public function getRegions()
    {
        $regions = Region::all();
        return response()->json($regions);
    }

    public function getProvinces($regionId)
    {
        $provinces = Province::where('region_id', $regionId)->get();
        return response()->json($provinces);
    }
    
    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();
        return response()->json($cities);
    }
    
    public function getBarangays($cityId)
    {
        $barangays = Barangay::where('city_id', $cityId)->get();
        return response()->json($barangays);
    }
    
}

