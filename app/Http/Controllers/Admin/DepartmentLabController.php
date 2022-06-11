<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDepartmentLabRequest;
use App\Http\Requests\StoreDepartmentLabRequest;
use App\Http\Requests\UpdateDepartmentLabRequest;
use App\Models\DepartmentLab;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DepartmentLabController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('department_lab_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DepartmentLab::query()->select(sprintf('%s.*', (new DepartmentLab())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'department_lab_show';
                $editGate = 'department_lab_edit';
                $deleteGate = 'department_lab_delete';
                $crudRoutePart = 'department-labs';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.departmentLabs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('department_lab_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.departmentLabs.create');
    }

    public function store(StoreDepartmentLabRequest $request)
    {
        $departmentLab = DepartmentLab::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $departmentLab->id]);
        }

        return redirect()->route('admin.department-labs.index');
    }

    public function edit(DepartmentLab $departmentLab)
    {
        abort_if(Gate::denies('department_lab_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.departmentLabs.edit', compact('departmentLab'));
    }

    public function update(UpdateDepartmentLabRequest $request, DepartmentLab $departmentLab)
    {
        $departmentLab->update($request->all());

        return redirect()->route('admin.department-labs.index');
    }

    public function show(DepartmentLab $departmentLab)
    {
        abort_if(Gate::denies('department_lab_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.departmentLabs.show', compact('departmentLab'));
    }

    public function destroy(DepartmentLab $departmentLab)
    {
        abort_if(Gate::denies('department_lab_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departmentLab->delete();

        return back();
    }

    public function massDestroy(MassDestroyDepartmentLabRequest $request)
    {
        DepartmentLab::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('department_lab_create') && Gate::denies('department_lab_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DepartmentLab();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
