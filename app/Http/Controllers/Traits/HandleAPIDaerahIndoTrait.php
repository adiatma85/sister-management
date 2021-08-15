<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

trait HandleAPIDaerahIndoTrait
{

    // Province
    public function handleProvince(){
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/provinsi");
        return json_decode($response->getBody()->getContents())->provinsi;
    }

    // Handlecity / Kota dan Kabupaten
    public function handleCity($provinceId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/kota?id_provinsi=" . $provinceId);
        return json_decode($response->getBody()->getContents())->kota_kabupaten;
    }

    // Handle SubDistrict / Kecamatan
    public function handleSubDistrict($cityId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/kecamatan?id_kota=" . $cityId);
        return json_decode($response->getBody()->getContents())->kecamatan;
    }

    // Handle Ward / Kelurahan
    public function handleWard($subDistrictId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/kelurahan?id_kecamatan=" . $subDistrictId);
        return json_decode($response->getBody()->getContents())->kelurahan;
    }
}
