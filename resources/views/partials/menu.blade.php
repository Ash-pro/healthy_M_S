<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('accounting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/salaries*") ? "c-show" : "" }} {{ request()->is("admin/salary-labs*") ? "c-show" : "" }} {{ request()->is("admin/pharmacist-salaries*") ? "c-show" : "" }} {{ request()->is("admin/customer-payments*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.accounting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('salary_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.salaries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/salaries") || request()->is("admin/salaries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.salary.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('salary_lab_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.salary-labs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/salary-labs") || request()->is("admin/salary-labs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.salaryLab.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('pharmacist_salary_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.pharmacist-salaries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pharmacist-salaries") || request()->is("admin/pharmacist-salaries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pharmacistSalary.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('customer_payment_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.customer-payments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/customer-payments") || request()->is("admin/customer-payments/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.customerPayment.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('doctor_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/departments*") ? "c-show" : "" }} {{ request()->is("admin/doctors*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-md c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.doctorManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('department_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.departments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bookmark c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.department.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('doctor_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.doctors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/doctors") || request()->is("admin/doctors/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-md c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.doctor.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('patient_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/patients*") ? "c-show" : "" }} {{ request()->is("admin/sick-records*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.patientManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('patient_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.patients.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/patients") || request()->is("admin/patients/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.patient.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('sick_record_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.sick-records.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sick-records") || request()->is("admin/sick-records/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-address-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.sickRecord.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('laboratory_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/department-labs*") ? "c-show" : "" }} {{ request()->is("admin/laborators*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-flask c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.laboratoryManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('department_lab_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.department-labs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/department-labs") || request()->is("admin/department-labs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bookmark c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.departmentLab.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('laborator_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.laborators.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/laborators") || request()->is("admin/laborators/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-shield c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.laborator.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('pharmacist_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.pharmacists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pharmacists") || request()->is("admin/pharmacists/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-user-md c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pharmacist.title') }}
                </a>
            </li>
        @endcan
        @can('contact_us_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.contactuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contactuses") || request()->is("admin/contactuses/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-phone-square c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contactUs.title') }}
                </a>
            </li>
        @endcan
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>