<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySickRecordRequest;
use App\Http\Requests\StoreSickRecordRequest;
use App\Http\Requests\UpdateSickRecordRequest;
use App\Models\Patient;
use App\Models\SickRecord;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SickRecordController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sick_record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SickRecord::with(['p_name'])->select(sprintf('%s.*', (new SickRecord())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sick_record_show';
                $editGate = 'sick_record_edit';
                $deleteGate = 'sick_record_delete';
                $crudRoutePart = 'sick-records';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('p_name_name', function ($row) {
                return $row->p_name ? $row->p_name->name : '';
            });

            $table->editColumn('receiving_medicine', function ($row) {
                return $row->receiving_medicine ? SickRecord::RECEIVING_MEDICINE_RADIO[$row->receiving_medicine] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'p_name']);

            return $table->make(true);
        }

        $patients = Patient::get();

        return view('admin.sickRecords.index', compact('patients'));
    }

    public function create()
    {
        abort_if(Gate::denies('sick_record_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $p_names = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sickRecords.create', compact('p_names'));
    }

    public function store(StoreSickRecordRequest $request)
    {
        $sickRecord = SickRecord::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sickRecord->id]);
        }

        return redirect()->route('admin.sick-records.index');
    }

    public function edit(SickRecord $sickRecord)
    {
        abort_if(Gate::denies('sick_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $p_names = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sickRecord->load('p_name');

        return view('admin.sickRecords.edit', compact('p_names', 'sickRecord'));
    }

    public function update(UpdateSickRecordRequest $request, SickRecord $sickRecord)
    {
        $sickRecord->update($request->all());

        return redirect()->route('admin.sick-records.index');
    }

    public function show(SickRecord $sickRecord)
    {
        abort_if(Gate::denies('sick_record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sickRecord->load('p_name');

        return view('admin.sickRecords.show', compact('sickRecord'));
    }

    public function destroy(SickRecord $sickRecord)
    {
        abort_if(Gate::denies('sick_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sickRecord->delete();

        return back();
    }

    public function massDestroy(MassDestroySickRecordRequest $request)
    {
        SickRecord::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sick_record_create') && Gate::denies('sick_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SickRecord();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
