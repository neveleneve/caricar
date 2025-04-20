<?php

namespace App\Http\Controllers;

use App\Models\IndonesiaProvince;
use App\Models\IndonesiaCity;
use App\Models\IndonesiaDistrict;
use App\Models\IndonesiaVillage;
use Illuminate\Http\Request;

class WilayahController extends Controller {
    public function province() {
        $provinces = IndonesiaProvince::all();
        return response()->json([
            'success' => true,
            'message' => 'Province list',
            'data' => $provinces
        ])->setStatusCode(200);
    }

    public function provinceByCode($province_code) {
        $province = IndonesiaProvince::where('code', $province_code)->first();
        if (!$province) {
            return response()->json(['message' => 'Province not found'], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Province details',
            'data' => $province
        ])->setStatusCode(200);
    }

    public function citiesByProvinceCode($province_code) {
        $cities = IndonesiaCity::where('province_code', $province_code)->get();
        if ($cities->isEmpty()) {
            return response()->json([
                'message' => 'No cities found for this province',
                'code' => 404
            ])->setStatusCode(404);
        }
        return response()->json([
            'success' => true,
            'message' => 'City list',
            'data' => $cities
        ])->setStatusCode(200);
    }

    public function city() {
        $cities = IndonesiaCity::all();
        if ($cities->isEmpty()) {
            return response()->json([
                'message' => 'No cities found',
                'code' => 404
            ])->setStatusCode(404);
        }
        return response()->json([
            'success' => true,
            'message' => 'City list',
            'data' => $cities
        ])->setStatusCode(200);
    }

    public function cityByCode($city_code) {
        $city = IndonesiaCity::where('code', $city_code)->first();
        if (!$city) {
            return response()->json([
                'message' => 'City not found',
                'code' => 404
            ])->setStatusCode(404);
        }
        return response()->json([
            'success' => true,
            'message' => 'City details',
            'data' => $city
        ])->setStatusCode(200);
    }

    public function districtsByCityCode($city_code) {
        $districts = IndonesiaDistrict::where('city_code', $city_code)->get();
        if ($districts->isEmpty()) {
            return response()->json([
                'message' => 'No districts found for this city',
                'code' => 404
            ])->setStatusCode(404);
        }
        return response()->json([
            'success' => true,
            'message' => 'District list',
            'data' => $districts
        ])->setStatusCode(200);
    }

    public function district() {
        $districts = IndonesiaDistrict::all();
        if ($districts->isEmpty()) {
            return response()->json([
                'message' => 'No districts found',
                'code' => 404
            ])->setStatusCode(404);
        }
        return response()->json([
            'success' => true,
            'message' => 'District list',
            'data' => $districts
        ])->setStatusCode(200);
    }

    public function districtByCode($district_code) {
        $district = IndonesiaDistrict::where('code', $district_code)->first();
        if (!$district) {
            return response()->json([
                'message' => 'District not found',
                'code' => 404
            ])->setStatusCode(404);
        }
        return response()->json([
            'success' => true,
            'message' => 'District details',
            'data' => $district
        ])->setStatusCode(200);
    }

    public function villagesByDistrictCode($district_code) {
        $villages = IndonesiaVillage::where('district_code', $district_code)->get();
        if ($villages->isEmpty()) {
            return response()->json([
                'message' => 'No villages found for this district',
                'code' => 404
            ])->setStatusCode(404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Village list',
            'data' => $villages
        ])->setStatusCode(200);
    }

    public function village() {
        $villages = IndonesiaVillage::all();
        if ($villages->isEmpty()) {
            return response()->json([
                'message' => 'No villages found',
                'code' => 404
            ])->setStatusCode(404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Village list',
            'data' => $villages
        ])->setStatusCode(200);
    }

    public function villageByCode($village_code) {
        $village = IndonesiaVillage::where('code', $village_code)->first();
        if (!$village) {
            return response()->json([
                'message' => 'Village not found',
                'code' => 404
            ])->setStatusCode(404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Village details',
            'data' => $village
        ])->setStatusCode(200);
    }
}
