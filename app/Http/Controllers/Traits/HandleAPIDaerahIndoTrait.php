<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

trait HandleAPIDaerahIndoTrait
{

    private $client;

    function __construct()
    {
        $this->client = new Client();
    }

    // Province
    public function handleProvince()
    {
        $response = $this->client->get(env('API_DAERAH_INDONESIA_BASE') . "/provinsi");
        return json_decode($response->getBody()->getContents())->provinsi;
    }

    // Get Detail Province
    public function getProvince($provinceId)
    {
        $response = $this->client->get(env('API_DAERAH_INDONESIA_BASE') . "/provinsi/$provinceId");
        return json_decode($response->getBody()->getContents());
    }

    // Handlecity / Kota dan Kabupaten
    public function handleCity($provinceId)
    {
        $response = $this->client->get(env('API_DAERAH_INDONESIA_BASE') . "/kota?id_provinsi=" . $provinceId);
        return json_decode($response->getBody()->getContents())->kota_kabupaten;
    }

    // Get Detail Kota dan kelurahan
    public function getCity($cityId)
    {
        $response = $this->client->get(env('API_DAERAH_INDONESIA_BASE') . "/kota/$cityId");
        return json_decode($response->getBody()->getContents());
    }

    // Handle SubDistrict / Kecamatan
    public function handleSubDistrict($cityId)
    {
        $response = $this->client->get(env('API_DAERAH_INDONESIA_BASE') . "/kecamatan?id_kota=" . $cityId);
        return json_decode($response->getBody()->getContents())->kecamatan;
    }

    // Get Detail SubDistrict / Kecamatan
    public function getSubDistrict($subDistrictId)
    {
        $response = $this->client->get(env('API_DAERAH_INDONESIA_BASE') . "/kecamatan/$subDistrictId");
        return json_decode($response->getBody()->getContents());
    }

    // Handle Ward / Kelurahan
    public function handleWard($subDistrictId)
    {
        $response = $this->client->get(env('API_DAERAH_INDONESIA_BASE') . "/kelurahan?id_kecamatan=" . $subDistrictId);
        return json_decode($response->getBody()->getContents())->kelurahan;
    }

    // Get Detail Ward / Kelurahan
    public function getWard($wardId)
    {
        $response = $this->client->get(env('API_DAERAH_INDONESIA_BASE') . "/kelurahan/$wardId");
        return json_decode($response->getBody()->getContents());
    }
}
