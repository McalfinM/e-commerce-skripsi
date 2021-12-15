<?php

namespace App\Repositories;

use App\Models\Cities;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;

class LocationRepository
{

    public function get_all_province()
    {
        return Province::orderBy('nama_provinsi', 'asc')->pluck('nama_provinsi', 'id');
    }

    public function get_all_city_from_province($id)
    {
        return Cities::where('province_id', $id)->get();
    }

    public function get_all_district_from_city($id)
    {
        return District::where('city_id', $id)->get();
    }

    public function get_city_from_name($name)
    {
        return Cities::where('nama_kota', 'LIKE', "%$name%")->first();
    }

    public function find_one_city($id)
    {
        return Cities::where('id', $id)->first();
    }

    public function find_one_district($id)
    {
        return District::where('id', $id)->first();
    }

    public function find_one_village($id)
    {
        return Village::where('id', $id)->first();
    }
}
