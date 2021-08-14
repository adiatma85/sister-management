<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSisterRequest;
use App\Http\Requests\UpdateSisterRequest;
use App\Http\Resources\Admin\SisterResource;
use App\Models\Sister;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SisterApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sister_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SisterResource(Sister::all());
    }

    public function store(StoreSisterRequest $request)
    {
        $sister = Sister::create($request->all());

        if ($request->input('self_image', false)) {
            $sister->addMedia(storage_path('tmp/uploads/' . basename($request->input('self_image'))))->toMediaCollection('self_image');
        }

        if ($request->input('ktp_image', false)) {
            $sister->addMedia(storage_path('tmp/uploads/' . basename($request->input('ktp_image'))))->toMediaCollection('ktp_image');
        }

        return (new SisterResource($sister))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Sister $sister)
    {
        abort_if(Gate::denies('sister_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SisterResource($sister);
    }

    public function update(UpdateSisterRequest $request, Sister $sister)
    {
        $sister->update($request->all());

        if ($request->input('self_image', false)) {
            if (!$sister->self_image || $request->input('self_image') !== $sister->self_image->file_name) {
                if ($sister->self_image) {
                    $sister->self_image->delete();
                }
                $sister->addMedia(storage_path('tmp/uploads/' . basename($request->input('self_image'))))->toMediaCollection('self_image');
            }
        } elseif ($sister->self_image) {
            $sister->self_image->delete();
        }

        if ($request->input('ktp_image', false)) {
            if (!$sister->ktp_image || $request->input('ktp_image') !== $sister->ktp_image->file_name) {
                if ($sister->ktp_image) {
                    $sister->ktp_image->delete();
                }
                $sister->addMedia(storage_path('tmp/uploads/' . basename($request->input('ktp_image'))))->toMediaCollection('ktp_image');
            }
        } elseif ($sister->ktp_image) {
            $sister->ktp_image->delete();
        }

        return (new SisterResource($sister))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Sister $sister)
    {
        abort_if(Gate::denies('sister_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sister->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
