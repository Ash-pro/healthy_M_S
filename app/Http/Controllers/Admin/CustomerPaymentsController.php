<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCustomerPaymentRequest;
use App\Http\Requests\StoreCustomerPaymentRequest;
use App\Http\Requests\UpdateCustomerPaymentRequest;
use App\Models\CustomerPayment;
use App\Models\Patient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerPaymentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('customer_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerPayments = CustomerPayment::with(['patient'])->get();

        $patients = Patient::get();

        return view('admin.customerPayments.index', compact('customerPayments', 'patients'));
    }

    public function create()
    {
        abort_if(Gate::denies('customer_payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customerPayments.create', compact('patients'));
    }

    public function store(StoreCustomerPaymentRequest $request)
    {
        $customerPayment = CustomerPayment::create($request->all());

        return redirect()->route('admin.customer-payments.index');
    }

    public function edit(CustomerPayment $customerPayment)
    {
        abort_if(Gate::denies('customer_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customerPayment->load('patient');

        return view('admin.customerPayments.edit', compact('customerPayment', 'patients'));
    }

    public function update(UpdateCustomerPaymentRequest $request, CustomerPayment $customerPayment)
    {
        $customerPayment->update($request->all());

        return redirect()->route('admin.customer-payments.index');
    }

    public function show(CustomerPayment $customerPayment)
    {
        abort_if(Gate::denies('customer_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerPayment->load('patient');

        return view('admin.customerPayments.show', compact('customerPayment'));
    }

    public function destroy(CustomerPayment $customerPayment)
    {
        abort_if(Gate::denies('customer_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerPayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyCustomerPaymentRequest $request)
    {
        CustomerPayment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
