<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySisterRequest;
use App\Http\Requests\StoreSisterRequest;
use App\Http\Requests\UpdateSisterRequest;
use App\Models\Sister;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SisterController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sister_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sisters = Sister::with(['media'])->get();

        return view('admin.sisters.index', compact('sisters'));
    }

    public function create()
    {
        abort_if(Gate::denies('sister_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sisters.create');
    }

    public function store(StoreSisterRequest $request)
    {
        $sister = Sister::create($request->all());

        foreach ($request->input('self_image', []) as $file) {
            $sister->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('self_image');
        }

        foreach ($request->input('ktp_image', []) as $file) {
            $sister->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('ktp_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sister->id]);
        }

        return redirect()->route('admin.sisters.index');
    }

    public function edit(Sister $sister)
    {
        abort_if(Gate::denies('sister_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sisters.edit', compact('sister'));
    }

    public function update(UpdateSisterRequest $request, Sister $sister)
    {
        $sister->update($request->all());

        if (count($sister->self_image) > 0) {
            foreach ($sister->self_image as $media) {
                if (!in_array($media->file_name, $request->input('self_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $sister->self_image->pluck('file_name')->toArray();
        foreach ($request->input('self_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $sister->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('self_image');
            }
        }

        if (count($sister->ktp_image) > 0) {
            foreach ($sister->ktp_image as $media) {
                if (!in_array($media->file_name, $request->input('ktp_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $sister->ktp_image->pluck('file_name')->toArray();
        foreach ($request->input('ktp_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $sister->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('ktp_image');
            }
        }

        return redirect()->route('admin.sisters.index');
    }

    public function show(Sister $sister)
    {
        abort_if(Gate::denies('sister_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sisters.show', compact('sister'));
    }

    public function destroy(Sister $sister)
    {
        abort_if(Gate::denies('sister_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sister->delete();

        return back();
    }

    public function massDestroy(MassDestroySisterRequest $request)
    {
        Sister::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sister_create') && Gate::denies('sister_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Sister();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
