<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySalaryRequest;
use App\Http\Requests\StoreSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Models\Doctor;
use App\Models\Salary;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SalaryController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('salary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Salary::with(['d_name'])->select(sprintf('%s.*', (new Salary())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'salary_show';
                $editGate = 'salary_edit';
                $deleteGate = 'salary_delete';
                $crudRoutePart = 'salaries';

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
            $table->addColumn('d_name_name', function ($row) {
                return $row->d_name ? $row->d_name->name : '';
            });

            $table->editColumn('d_salary', function ($row) {
                return $row->d_salary ? $row->d_salary : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'd_name']);

            return $table->make(true);
        }

        $doctors = Doctor::get();

        return view('admin.salaries.index', compact('doctors'));
    }

    public function create()
    {
        abort_if(Gate::denies('salary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $d_names = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.salaries.create', compact('d_names'));
    }

    public function store(StoreSalaryRequest $request)
    {
        $salary = Salary::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $salary->id]);
        }

        return redirect()->route('admin.salaries.index');
    }

    public function edit(Salary $salary)
    {
        abort_if(Gate::denies('salary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $d_names = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salary->load('d_name');

        return view('admin.salaries.edit', compact('d_names', 'salary'));
    }

    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
        $salary->update($request->all());

        return redirect()->route('admin.salaries.index');
    }

    public function show(Salary $salary)
    {
        abort_if(Gate::denies('salary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary->load('d_name');

        return view('admin.salaries.show', compact('salary'));
    }

    public function destroy(Salary $salary)
    {
        abort_if(Gate::denies('salary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary->delete();

        return back();
    }

    public function massDestroy(MassDestroySalaryRequest $request)
    {
        Salary::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('salary_create') && Gate::denies('salary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Salary();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
