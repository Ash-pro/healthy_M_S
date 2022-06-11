<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    private $models = [
        'User'             => 'cruds.user.title',
        'Doctor'           => 'cruds.doctor.title',
        'Salary'           => 'cruds.salary.title',
        'Patient'          => 'cruds.patient.title',
        'SickRecord'       => 'cruds.sickRecord.title',
        'Laborator'        => 'cruds.laborator.title',
        'SalaryLab'        => 'cruds.salaryLab.title',
        'ContactUs'        => 'cruds.contactUs.title',
        'CustomerPayment'  => 'cruds.customerPayment.title',
        'Pharmacist'       => 'cruds.pharmacist.title',
        'PharmacistSalary' => 'cruds.pharmacistSalary.title',
    ];

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search === null || !isset($search['term'])) {
            abort(400);
        }

        $term           = $search['term'];
        $searchableData = [];
        foreach ($this->models as $model => $translation) {
            $modelClass = 'App\Models\\' . $model;
            $query      = $modelClass::query();

            $fields = $modelClass::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%' . $term . '%');
            }

            $results = $query->take(10)
                ->get();

            foreach ($results as $result) {
                $parsedData           = $result->only($fields);
                $parsedData['model']  = trans($translation);
                $parsedData['fields'] = $fields;
                $formattedFields      = [];
                foreach ($fields as $field) {
                    $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                }
                $parsedData['fields_formated'] = $formattedFields;

                $parsedData['url'] = url('/admin/' . Str::plural(Str::snake($model, '-')) . '/' . $result->id . '/edit');

                $searchableData[] = $parsedData;
            }
        }

        return response()->json(['results' => $searchableData]);
    }
}
