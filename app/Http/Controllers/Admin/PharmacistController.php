<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPharmacistRequest;
use App\Http\Requests\StorePharmacistRequest;
use App\Http\Requests\UpdatePharmacistRequest;
use App\Models\Pharmacist;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PharmacistController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pharmacist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacists = Pharmacist::with(['user_account'])->get();

        $users = User::get();

        return view('admin.pharmacists.index', compact('pharmacists', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_accounts = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pharmacists.create', compact('user_accounts'));
    }

    public function store(StorePharmacistRequest $request)
    {
        $pharmacist = Pharmacist::create($request->all());

        return redirect()->route('admin.pharmacists.index');
    }

    public function edit(Pharmacist $pharmacist)
    {
        abort_if(Gate::denies('pharmacist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_accounts = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pharmacist->load('user_account');

        return view('admin.pharmacists.edit', compact('pharmacist', 'user_accounts'));
    }

    public function update(UpdatePharmacistRequest $request, Pharmacist $pharmacist)
    {
        $pharmacist->update($request->all());

        return redirect()->route('admin.pharmacists.index');
    }

    public function show(Pharmacist $pharmacist)
    {
        abort_if(Gate::denies('pharmacist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacist->load('user_account', 'pNamePharmacistSalaries');

        return view('admin.pharmacists.show', compact('pharmacist'));
    }

    public function destroy(Pharmacist $pharmacist)
    {
        abort_if(Gate::denies('pharmacist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacist->delete();

        return back();
    }

    public function massDestroy(MassDestroyPharmacistRequest $request)
    {
        Pharmacist::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
