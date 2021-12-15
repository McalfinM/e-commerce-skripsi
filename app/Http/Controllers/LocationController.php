<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $locationService;
    protected $rajaOngkirService;

    public function __construct(LocationService $locationService, RajaOngkirService $rajaOngkirService)
    {
        $this->locationService = $locationService;
        $this->rajaOngkirService = $rajaOngkirService;
    }

    public function get_all_province()
    {
        return $this->locationService->get_all_province();
    }

    public function get_all_city_from_province($id)
    {
        $data = $this->locationService->get_all_city_from_province($id);
        return response()->json(['cities' => $data], 200);
    }

    public function get_all_district_from_city($name)
    {

        $data =  $this->locationService->get_all_district_from_city($name);
        return response()->json(['districts' => $data], 200);
    }

    public function get_city_from_province_rajaongkir($id)
    {
        $data = $this->rajaOngkirService->getCityFromProvince($id);
        return json_decode($data);
    }
}
