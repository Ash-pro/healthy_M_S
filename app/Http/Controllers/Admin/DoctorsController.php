<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDoctorRequest;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DoctorsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Doctor::with(['department', 'user_account'])->select(sprintf('%s.*', (new Doctor())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'doctor_show';
                $editGate = 'doctor_edit';
                $deleteGate = 'doctor_delete';
                $crudRoutePart = 'doctors';

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
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('specialty', function ($row) {
                return $row->specialty ? $row->specialty : '';
            });
            $table->addColumn('user_account_name', function ($row) {
                return $row->user_account ? $row->user_account->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_account']);

            return $table->make(true);
        }

        $departments = Department::get();
        $users       = User::get();

        return view('admin.doctors.index', compact('departments', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_accounts = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.doctors.create', compact('departments', 'user_accounts'));
    }

    public function store(StoreDoctorRequest $request)
    {
        $doctor = Doctor::create($request->all());

        return redirect()->route('admin.doctors.index');
    }

    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_accounts = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctor->load('department', 'user_account');

        return view('admin.doctors.edit', compact('departments', 'doctor', 'user_accounts'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->all());

        return redirect()->route('admin.doctors.index');
    }

    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->load('department', 'user_account', 'dNameSalaries');

        return view('admin.doctors.show', compact('doctor'));
    }

    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoctorRequest $request)
    {
        Doctor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
