<?php

namespace App\Services;

use App\Repositories\LocationRepository;

class LocationService
{

    protected $locationRepository;
    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }


    public function get_all_province()
    {
        return $this->locationRepository->get_all_province();
    }

    public function get_all_city_from_province($id)
    {
        return $this->locationRepository->get_all_city_from_province($id);
    }

    public function get_all_district_from_city($id)
    {
        return $this->locationRepository->get_all_district_from_city($id);
    }
    public function get_city_from_name($type, $name)
    {
        if ($type === 'Kota') {
            $type = 'Kota ';
        } else if ($type === 'Kabupaten') {
            $type = 'Kab. ';
        }
        $payload = $type . $name;

        return $this->locationRepository->get_city_from_name($payload);
    }
}
