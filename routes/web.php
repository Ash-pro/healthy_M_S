<?php
Route::redirect('/login', '/login');

Route::get('/', 'indexController@about')->name('about');
Route::get('/contact', 'indexController@contact')->name('contact');
Route::post('/contact_store', 'indexController@contact_store')->name('contact_store');
Route::get('/contact', 'indexController@contact')->name('contact');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Doctors
    Route::delete('doctors/destroy', 'DoctorsController@massDestroy')->name('doctors.massDestroy');
    Route::resource('doctors', 'DoctorsController');

    // Department
    Route::delete('departments/destroy', 'DepartmentController@massDestroy')->name('departments.massDestroy');
    Route::post('departments/media', 'DepartmentController@storeMedia')->name('departments.storeMedia');
    Route::post('departments/ckmedia', 'DepartmentController@storeCKEditorImages')->name('departments.storeCKEditorImages');
    Route::resource('departments', 'DepartmentController');

    // Salary
    Route::delete('salaries/destroy', 'SalaryController@massDestroy')->name('salaries.massDestroy');
    Route::post('salaries/media', 'SalaryController@storeMedia')->name('salaries.storeMedia');
    Route::post('salaries/ckmedia', 'SalaryController@storeCKEditorImages')->name('salaries.storeCKEditorImages');
    Route::resource('salaries', 'SalaryController');

    // Patient
    Route::delete('patients/destroy', 'PatientController@massDestroy')->name('patients.massDestroy');
    Route::post('patients/media', 'PatientController@storeMedia')->name('patients.storeMedia');
    Route::post('patients/ckmedia', 'PatientController@storeCKEditorImages')->name('patients.storeCKEditorImages');
    Route::resource('patients', 'PatientController');

    // Sick Record
    Route::delete('sick-records/destroy', 'SickRecordController@massDestroy')->name('sick-records.massDestroy');
    Route::post('sick-records/media', 'SickRecordController@storeMedia')->name('sick-records.storeMedia');
    Route::post('sick-records/ckmedia', 'SickRecordController@storeCKEditorImages')->name('sick-records.storeCKEditorImages');
    Route::resource('sick-records', 'SickRecordController');

    // Laborator
    Route::delete('laborators/destroy', 'LaboratorController@massDestroy')->name('laborators.massDestroy');
    Route::resource('laborators', 'LaboratorController');

    // Department Lab
    Route::delete('department-labs/destroy', 'DepartmentLabController@massDestroy')->name('department-labs.massDestroy');
    Route::post('department-labs/media', 'DepartmentLabController@storeMedia')->name('department-labs.storeMedia');
    Route::post('department-labs/ckmedia', 'DepartmentLabController@storeCKEditorImages')->name('department-labs.storeCKEditorImages');
    Route::resource('department-labs', 'DepartmentLabController');

    // Salary Lab
    Route::delete('salary-labs/destroy', 'SalaryLabController@massDestroy')->name('salary-labs.massDestroy');
    Route::post('salary-labs/media', 'SalaryLabController@storeMedia')->name('salary-labs.storeMedia');
    Route::post('salary-labs/ckmedia', 'SalaryLabController@storeCKEditorImages')->name('salary-labs.storeCKEditorImages');
    Route::resource('salary-labs', 'SalaryLabController');

    // Contact Us
    Route::delete('contactuses/destroy', 'ContactUsController@massDestroy')->name('contactuses.massDestroy');
    Route::post('contactuses/media', 'ContactUsController@storeMedia')->name('contactuses.storeMedia');
    Route::post('contactuses/ckmedia', 'ContactUsController@storeCKEditorImages')->name('contactuses.storeCKEditorImages');
    Route::resource('contactuses', 'ContactUsController');

    // Customer Payments
    Route::delete('customer-payments/destroy', 'CustomerPaymentsController@massDestroy')->name('customer-payments.massDestroy');
    Route::resource('customer-payments', 'CustomerPaymentsController');

    // Pharmacist
    Route::delete('pharmacists/destroy', 'PharmacistController@massDestroy')->name('pharmacists.massDestroy');
    Route::resource('pharmacists', 'PharmacistController');

    // Pharmacist Salary
    Route::delete('pharmacist-salaries/destroy', 'PharmacistSalaryController@massDestroy')->name('pharmacist-salaries.massDestroy');
    Route::post('pharmacist-salaries/media', 'PharmacistSalaryController@storeMedia')->name('pharmacist-salaries.storeMedia');
    Route::post('pharmacist-salaries/ckmedia', 'PharmacistSalaryController@storeCKEditorImages')->name('pharmacist-salaries.storeCKEditorImages');
    Route::resource('pharmacist-salaries', 'PharmacistSalaryController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
