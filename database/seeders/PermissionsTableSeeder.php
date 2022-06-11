<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'doctor_management_access',
            ],
            [
                'id'    => 20,
                'title' => 'doctor_create',
            ],
            [
                'id'    => 21,
                'title' => 'doctor_edit',
            ],
            [
                'id'    => 22,
                'title' => 'doctor_show',
            ],
            [
                'id'    => 23,
                'title' => 'doctor_delete',
            ],
            [
                'id'    => 24,
                'title' => 'doctor_access',
            ],
            [
                'id'    => 25,
                'title' => 'department_create',
            ],
            [
                'id'    => 26,
                'title' => 'department_edit',
            ],
            [
                'id'    => 27,
                'title' => 'department_show',
            ],
            [
                'id'    => 28,
                'title' => 'department_delete',
            ],
            [
                'id'    => 29,
                'title' => 'department_access',
            ],
            [
                'id'    => 30,
                'title' => 'salary_create',
            ],
            [
                'id'    => 31,
                'title' => 'salary_edit',
            ],
            [
                'id'    => 32,
                'title' => 'salary_show',
            ],
            [
                'id'    => 33,
                'title' => 'salary_delete',
            ],
            [
                'id'    => 34,
                'title' => 'salary_access',
            ],
            [
                'id'    => 35,
                'title' => 'patient_management_access',
            ],
            [
                'id'    => 36,
                'title' => 'patient_create',
            ],
            [
                'id'    => 37,
                'title' => 'patient_edit',
            ],
            [
                'id'    => 38,
                'title' => 'patient_show',
            ],
            [
                'id'    => 39,
                'title' => 'patient_delete',
            ],
            [
                'id'    => 40,
                'title' => 'patient_access',
            ],
            [
                'id'    => 41,
                'title' => 'sick_record_create',
            ],
            [
                'id'    => 42,
                'title' => 'sick_record_edit',
            ],
            [
                'id'    => 43,
                'title' => 'sick_record_show',
            ],
            [
                'id'    => 44,
                'title' => 'sick_record_delete',
            ],
            [
                'id'    => 45,
                'title' => 'sick_record_access',
            ],
            [
                'id'    => 46,
                'title' => 'laboratory_management_access',
            ],
            [
                'id'    => 47,
                'title' => 'laborator_create',
            ],
            [
                'id'    => 48,
                'title' => 'laborator_edit',
            ],
            [
                'id'    => 49,
                'title' => 'laborator_show',
            ],
            [
                'id'    => 50,
                'title' => 'laborator_delete',
            ],
            [
                'id'    => 51,
                'title' => 'laborator_access',
            ],
            [
                'id'    => 52,
                'title' => 'department_lab_create',
            ],
            [
                'id'    => 53,
                'title' => 'department_lab_edit',
            ],
            [
                'id'    => 54,
                'title' => 'department_lab_show',
            ],
            [
                'id'    => 55,
                'title' => 'department_lab_delete',
            ],
            [
                'id'    => 56,
                'title' => 'department_lab_access',
            ],
            [
                'id'    => 57,
                'title' => 'salary_lab_create',
            ],
            [
                'id'    => 58,
                'title' => 'salary_lab_edit',
            ],
            [
                'id'    => 59,
                'title' => 'salary_lab_show',
            ],
            [
                'id'    => 60,
                'title' => 'salary_lab_delete',
            ],
            [
                'id'    => 61,
                'title' => 'salary_lab_access',
            ],
            [
                'id'    => 62,
                'title' => 'contact_us_create',
            ],
            [
                'id'    => 63,
                'title' => 'contact_us_edit',
            ],
            [
                'id'    => 64,
                'title' => 'contact_us_show',
            ],
            [
                'id'    => 65,
                'title' => 'contact_us_delete',
            ],
            [
                'id'    => 66,
                'title' => 'contact_us_access',
            ],
            [
                'id'    => 67,
                'title' => 'accounting_access',
            ],
            [
                'id'    => 68,
                'title' => 'customer_payment_create',
            ],
            [
                'id'    => 69,
                'title' => 'customer_payment_edit',
            ],
            [
                'id'    => 70,
                'title' => 'customer_payment_show',
            ],
            [
                'id'    => 71,
                'title' => 'customer_payment_delete',
            ],
            [
                'id'    => 72,
                'title' => 'customer_payment_access',
            ],
            [
                'id'    => 73,
                'title' => 'pharmacist_create',
            ],
            [
                'id'    => 74,
                'title' => 'pharmacist_edit',
            ],
            [
                'id'    => 75,
                'title' => 'pharmacist_show',
            ],
            [
                'id'    => 76,
                'title' => 'pharmacist_delete',
            ],
            [
                'id'    => 77,
                'title' => 'pharmacist_access',
            ],
            [
                'id'    => 78,
                'title' => 'pharmacist_salary_create',
            ],
            [
                'id'    => 79,
                'title' => 'pharmacist_salary_edit',
            ],
            [
                'id'    => 80,
                'title' => 'pharmacist_salary_show',
            ],
            [
                'id'    => 81,
                'title' => 'pharmacist_salary_delete',
            ],
            [
                'id'    => 82,
                'title' => 'pharmacist_salary_access',
            ],
            [
                'id'    => 83,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
