<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySalaryLabRequest;
use App\Http\Requests\StoreSalaryLabRequest;
use App\Http\Requests\UpdateSalaryLabRequest;
use App\Models\Laborator;
use App\Models\SalaryLab;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SalaryLabController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('salary_lab_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SalaryLab::with(['laboratories'])->select(sprintf('%s.*', (new SalaryLab())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'salary_lab_show';
                $editGate = 'salary_lab_edit';
                $deleteGate = 'salary_lab_delete';
                $crudRoutePart = 'salary-labs';

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
            $table->addColumn('laboratories_name', function ($row) {
                return $row->laboratories ? $row->laboratories->name : '';
            });

            $table->editColumn('salary', function ($row) {
                return $row->salary ? $row->salary : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'laboratories']);

            return $table->make(true);
        }

        $laborators = Laborator::get();

        return view('admin.salaryLabs.index', compact('laborators'));
    }

    public function create()
    {
        abort_if(Gate::denies('salary_lab_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $laboratories = Laborator::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.salaryLabs.create', compact('laboratories'));
    }

    public function store(StoreSalaryLabRequest $request)
    {
        $salaryLab = SalaryLab::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $salaryLab->id]);
        }

        return redirect()->route('admin.salary-labs.index');
    }

    public function edit(SalaryLab $salaryLab)
    {
        abort_if(Gate::denies('salary_lab_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $laboratories = Laborator::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salaryLab->load('laboratories');

        return view('admin.salaryLabs.edit', compact('laboratories', 'salaryLab'));
    }

    public function update(UpdateSalaryLabRequest $request, SalaryLab $salaryLab)
    {
        $salaryLab->update($request->all());

        return redirect()->route('admin.salary-labs.index');
    }

    public function show(SalaryLab $salaryLab)
    {
        abort_if(Gate::denies('salary_lab_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaryLab->load('laboratories');

        return view('admin.salaryLabs.show', compact('salaryLab'));
    }

    public function destroy(SalaryLab $salaryLab)
    {
        abort_if(Gate::denies('salary_lab_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaryLab->delete();

        return back();
    }

    public function massDestroy(MassDestroySalaryLabRequest $request)
    {
        SalaryLab::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('salary_lab_create') && Gate::denies('salary_lab_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SalaryLab();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
