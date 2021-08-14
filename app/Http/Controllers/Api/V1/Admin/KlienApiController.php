<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreKlienRequest;
use App\Http\Requests\UpdateKlienRequest;
use App\Http\Resources\Admin\KlienResource;
use App\Models\Klien;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KlienApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('klien_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KlienResource(Klien::all());
    }

    public function store(StoreKlienRequest $request)
    {
        $klien = Klien::create($request->all());

        if ($request->input('self_image', false)) {
            $klien->addMedia(storage_path('tmp/uploads/' . basename($request->input('self_image'))))->toMediaCollection('self_image');
        }

        return (new KlienResource($klien))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Klien $klien)
    {
        abort_if(Gate::denies('klien_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KlienResource($klien);
    }

    public function update(UpdateKlienRequest $request, Klien $klien)
    {
        $klien->update($request->all());

        if ($request->input('self_image', false)) {
            if (!$klien->self_image || $request->input('self_image') !== $klien->self_image->file_name) {
                if ($klien->self_image) {
                    $klien->self_image->delete();
                }
                $klien->addMedia(storage_path('tmp/uploads/' . basename($request->input('self_image'))))->toMediaCollection('self_image');
            }
        } elseif ($klien->self_image) {
            $klien->self_image->delete();
        }

        return (new KlienResource($klien))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Klien $klien)
    {
        abort_if(Gate::denies('klien_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $klien->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
