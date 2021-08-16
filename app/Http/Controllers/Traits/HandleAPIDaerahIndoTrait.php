<?php

namespace App\Http\Controllers\Traits;

use GuzzleHttp\Client;

trait HandleAPIDaerahIndoTrait
{

    // Province
    public function handleProvince()
    {   
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/provinsi");
        return json_decode($response->getBody()->getContents())->provinsi;
    }

    // Get Detail Province
    public function getProvince($provinceId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/provinsi/$provinceId");
        return json_decode($response->getBody()->getContents());
    }

    // Handlecity / Kota dan Kabupaten
    public function handleCity($provinceId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/kota?id_provinsi=" . $provinceId);
        return json_decode($response->getBody()->getContents())->kota_kabupaten;
    }

    // Get Detail Kota dan kelurahan
    public function getCity($cityId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/kota/$cityId");
        return json_decode($response->getBody()->getContents());
    }

    // Handle SubDistrict / Kecamatan
    public function handleSubDistrict($cityId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/kecamatan?id_kota=" . $cityId);
        return json_decode($response->getBody()->getContents())->kecamatan;
    }

    // Get Detail SubDistrict / Kecamatan
    public function getSubDistrict($subDistrictId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/kecamatan/$subDistrictId");
        return json_decode($response->getBody()->getContents());
    }

    // Handle Ward / Kelurahan
    public function handleWard($subDistrictId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/kelurahan?id_kecamatan=" . $subDistrictId);
        return json_decode($response->getBody()->getContents())->kelurahan;
    }

    // Get Detail Ward / Kelurahan
    public function getWard($wardId)
    {
        $client = new Client();
        $response = $client->get(env('API_DAERAH_INDONESIA_BASE') . "/kelurahan/$wardId");
        return json_decode($response->getBody()->getContents());
    }
}
