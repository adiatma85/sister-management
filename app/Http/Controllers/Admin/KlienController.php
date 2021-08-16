<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Controllers\Traits\HandleAPIDaerahIndoTrait;
use App\Http\Requests\MassDestroyKlienRequest;
use App\Http\Requests\StoreKlienRequest;
use App\Http\Requests\UpdateKlienRequest;
use App\Models\Klien;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class KlienController extends Controller
{
    use MediaUploadingTrait;
    use HandleAPIDaerahIndoTrait;

    public function index()
    {
        abort_if(Gate::denies('klien_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kliens = Klien::with(['media'])->get();

        return view('admin.kliens.index', compact('kliens'));
    }

    public function create()
    {
        abort_if(Gate::denies('klien_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kliens.create');
    }

    public function store(StoreKlienRequest $request)
    {
        $klien = Klien::create($request->all());

        foreach ($request->input('self_image', []) as $file) {
            $klien->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('self_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $klien->id]);
        }

        return redirect()->route('admin.kliens.index');
    }

    public function edit(Klien $klien)
    {
        abort_if(Gate::denies('klien_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kliens.edit', compact('klien'));
    }

    public function update(UpdateKlienRequest $request, Klien $klien)
    {
        $klien->update($request->all());

        if (count($klien->self_image) > 0) {
            foreach ($klien->self_image as $media) {
                if (!in_array($media->file_name, $request->input('self_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $klien->self_image->pluck('file_name')->toArray();
        foreach ($request->input('self_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $klien->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('self_image');
            }
        }

        return redirect()->route('admin.kliens.index');
    }

    public function show(Klien $klien)
    {
        abort_if(Gate::denies('klien_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kliens.show', compact('klien'));
    }

    public function destroy(Klien $klien)
    {
        abort_if(Gate::denies('klien_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $klien->delete();

        return back();
    }

    public function massDestroy(MassDestroyKlienRequest $request)
    {
        Klien::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('klien_create') && Gate::denies('klien_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Klien();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
