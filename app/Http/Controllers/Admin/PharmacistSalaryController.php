<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPharmacistSalaryRequest;
use App\Http\Requests\StorePharmacistSalaryRequest;
use App\Http\Requests\UpdatePharmacistSalaryRequest;
use App\Models\Pharmacist;
use App\Models\PharmacistSalary;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PharmacistSalaryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pharmacist_salary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacistSalaries = PharmacistSalary::with(['p_name'])->get();

        $pharmacists = Pharmacist::get();

        return view('admin.pharmacistSalaries.index', compact('pharmacistSalaries', 'pharmacists'));
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacist_salary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $p_names = Pharmacist::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pharmacistSalaries.create', compact('p_names'));
    }

    public function store(StorePharmacistSalaryRequest $request)
    {
        $pharmacistSalary = PharmacistSalary::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pharmacistSalary->id]);
        }

        return redirect()->route('admin.pharmacist-salaries.index');
    }

    public function edit(PharmacistSalary $pharmacistSalary)
    {
        abort_if(Gate::denies('pharmacist_salary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $p_names = Pharmacist::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pharmacistSalary->load('p_name');

        return view('admin.pharmacistSalaries.edit', compact('p_names', 'pharmacistSalary'));
    }

    public function update(UpdatePharmacistSalaryRequest $request, PharmacistSalary $pharmacistSalary)
    {
        $pharmacistSalary->update($request->all());

        return redirect()->route('admin.pharmacist-salaries.index');
    }

    public function show(PharmacistSalary $pharmacistSalary)
    {
        abort_if(Gate::denies('pharmacist_salary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacistSalary->load('p_name');

        return view('admin.pharmacistSalaries.show', compact('pharmacistSalary'));
    }

    public function destroy(PharmacistSalary $pharmacistSalary)
    {
        abort_if(Gate::denies('pharmacist_salary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacistSalary->delete();

        return back();
    }

    public function massDestroy(MassDestroyPharmacistSalaryRequest $request)
    {
        PharmacistSalary::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pharmacist_salary_create') && Gate::denies('pharmacist_salary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PharmacistSalary();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
