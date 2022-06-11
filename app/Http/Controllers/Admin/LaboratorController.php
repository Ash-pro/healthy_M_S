<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLaboratorRequest;
use App\Http\Requests\StoreLaboratorRequest;
use App\Http\Requests\UpdateLaboratorRequest;
use App\Models\Laborator;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LaboratorController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('laborator_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Laborator::with(['user_account'])->select(sprintf('%s.*', (new Laborator())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'laborator_show';
                $editGate = 'laborator_edit';
                $deleteGate = 'laborator_delete';
                $crudRoutePart = 'laborators';

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
            $table->editColumn('specialty', function ($row) {
                return $row->specialty ? $row->specialty : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->addColumn('user_account_name', function ($row) {
                return $row->user_account ? $row->user_account->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_account']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.laborators.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('laborator_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_accounts = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.laborators.create', compact('user_accounts'));
    }

    public function store(StoreLaboratorRequest $request)
    {
        $laborator = Laborator::create($request->all());

        return redirect()->route('admin.laborators.index');
    }

    public function edit(Laborator $laborator)
    {
        abort_if(Gate::denies('laborator_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_accounts = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $laborator->load('user_account');

        return view('admin.laborators.edit', compact('laborator', 'user_accounts'));
    }

    public function update(UpdateLaboratorRequest $request, Laborator $laborator)
    {
        $laborator->update($request->all());

        return redirect()->route('admin.laborators.index');
    }

    public function show(Laborator $laborator)
    {
        abort_if(Gate::denies('laborator_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $laborator->load('user_account', 'laboratoriesSalaryLabs');

        return view('admin.laborators.show', compact('laborator'));
    }

    public function destroy(Laborator $laborator)
    {
        abort_if(Gate::denies('laborator_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $laborator->delete();

        return back();
    }

    public function massDestroy(MassDestroyLaboratorRequest $request)
    {
        Laborator::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
