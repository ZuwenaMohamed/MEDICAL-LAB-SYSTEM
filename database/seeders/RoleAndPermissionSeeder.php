<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $features = [
            'Dashboard',
            'Patients',
            'Visits & Appointments',
            'Clinical',
            'Laboratory',
            'Pharmacy',
            'Medical Records',
            'Employees',
            'Roles & Permissions',
            'Billing',
            'Reports',
            'Notifications',
            'Audit',
            'System',
        ];

        foreach ($features as $featureName) {
            Feature::updateOrCreate(
                ['name' => $featureName],
                ['name' => $featureName]
            );
        }

        $permissions = [

            // Dashboard
            ['feature' => 'Dashboard', 'name' => 'dashboard.view', 'display_name' => 'View Dashboard'],

            // Patients
            ['feature' => 'Patients', 'name' => 'patients.view', 'display_name' => 'View Patients'],
            ['feature' => 'Patients', 'name' => 'patients.create', 'display_name' => 'Register Patients'],
            ['feature' => 'Patients', 'name' => 'patients.edit', 'display_name' => 'Edit Patients'],
            ['feature' => 'Patients', 'name' => 'patients.delete', 'display_name' => 'Delete Patients'],
            ['feature' => 'Patients', 'name' => 'patients.activate', 'display_name' => 'Activate Patients'],
            ['feature' => 'Patients', 'name' => 'patients.deactivate', 'display_name' => 'Deactivate Patients'],

            // Visits & Appointments
            ['feature' => 'Visits & Appointments', 'name' => 'visits.view', 'display_name' => 'View Visits'],
            ['feature' => 'Visits & Appointments', 'name' => 'visits.create', 'display_name' => 'Create Visits'],
            ['feature' => 'Visits & Appointments', 'name' => 'visits.edit', 'display_name' => 'Edit Visits'],
            ['feature' => 'Visits & Appointments', 'name' => 'visits.cancel', 'display_name' => 'Cancel Visits'],
            ['feature' => 'Visits & Appointments', 'name' => 'appointments.view', 'display_name' => 'View Appointments'],
            ['feature' => 'Visits & Appointments', 'name' => 'appointments.create', 'display_name' => 'Create Appointments'],
            ['feature' => 'Visits & Appointments', 'name' => 'appointments.edit', 'display_name' => 'Edit Appointments'],
            ['feature' => 'Visits & Appointments', 'name' => 'appointments.cancel', 'display_name' => 'Cancel Appointments'],

            // Clinical
            ['feature' => 'Clinical', 'name' => 'clinical.view', 'display_name' => 'View Clinical Records'],
            ['feature' => 'Clinical', 'name' => 'clinical.create', 'display_name' => 'Create Clinical Records'],
            ['feature' => 'Clinical', 'name' => 'clinical.edit', 'display_name' => 'Edit Clinical Records'],
            ['feature' => 'Clinical', 'name' => 'clinical.delete', 'display_name' => 'Delete Clinical Records'],
            ['feature' => 'Clinical', 'name' => 'clinical.diagnose', 'display_name' => 'Record Diagnosis'],
            ['feature' => 'Clinical', 'name' => 'clinical.prescribe', 'display_name' => 'Prescribe Medication'],
            ['feature' => 'Clinical', 'name' => 'clinical.order-laboratory', 'display_name' => 'Order Laboratory Tests'],

            // Laboratory
            ['feature' => 'Laboratory', 'name' => 'laboratory.view', 'display_name' => 'View Laboratory'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.tests.view', 'display_name' => 'View Laboratory Tests'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.tests.create', 'display_name' => 'Create Laboratory Tests'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.tests.edit', 'display_name' => 'Edit Laboratory Tests'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.tests.delete', 'display_name' => 'Delete Laboratory Tests'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.orders.view', 'display_name' => 'View Laboratory Orders'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.orders.create', 'display_name' => 'Create Laboratory Orders'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.sample.collect', 'display_name' => 'Collect Samples'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.sample.receive', 'display_name' => 'Receive Samples'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.process', 'display_name' => 'Process Laboratory Tests'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.results.view', 'display_name' => 'View Laboratory Results'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.results.create', 'display_name' => 'Enter Laboratory Results'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.results.edit', 'display_name' => 'Edit Laboratory Results'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.results.validate', 'display_name' => 'Validate Laboratory Results'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.results.authorize', 'display_name' => 'Authorize Laboratory Results'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.reports.view', 'display_name' => 'View Laboratory Reports'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.reports.generate', 'display_name' => 'Generate Laboratory Reports'],
            ['feature' => 'Laboratory', 'name' => 'laboratory.reports.download', 'display_name' => 'Download Laboratory Reports'],

            // Pharmacy
            ['feature' => 'Pharmacy', 'name' => 'pharmacy.view', 'display_name' => 'View Pharmacy'],
            ['feature' => 'Pharmacy', 'name' => 'pharmacy.medicines.view', 'display_name' => 'View Medicines'],
            ['feature' => 'Pharmacy', 'name' => 'pharmacy.medicines.create', 'display_name' => 'Add Medicines'],
            ['feature' => 'Pharmacy', 'name' => 'pharmacy.medicines.edit', 'display_name' => 'Edit Medicines'],
            ['feature' => 'Pharmacy', 'name' => 'pharmacy.medicines.delete', 'display_name' => 'Delete Medicines'],
            ['feature' => 'Pharmacy', 'name' => 'pharmacy.dispense', 'display_name' => 'Dispense Medicines'],
            ['feature' => 'Pharmacy', 'name' => 'pharmacy.prescriptions.view', 'display_name' => 'View Prescriptions'],
            ['feature' => 'Pharmacy', 'name' => 'pharmacy.stock.view', 'display_name' => 'View Pharmacy Stock'],
            ['feature' => 'Pharmacy', 'name' => 'pharmacy.stock.manage', 'display_name' => 'Manage Pharmacy Stock'],

            // Medical Records
            ['feature' => 'Medical Records', 'name' => 'medical-records.view', 'display_name' => 'View Medical Records'],
            ['feature' => 'Medical Records', 'name' => 'medical-records.create', 'display_name' => 'Create Medical Records'],
            ['feature' => 'Medical Records', 'name' => 'medical-records.edit', 'display_name' => 'Edit Medical Records'],
            ['feature' => 'Medical Records', 'name' => 'medical-records.archive', 'display_name' => 'Archive Medical Records'],

            // Employees
            ['feature' => 'Employees', 'name' => 'employees.view', 'display_name' => 'View Employees'],
            ['feature' => 'Employees', 'name' => 'employees.create', 'display_name' => 'Create Employees'],
            ['feature' => 'Employees', 'name' => 'employees.edit', 'display_name' => 'Edit Employees'],
            ['feature' => 'Employees', 'name' => 'employees.delete', 'display_name' => 'Delete Employees'],
            ['feature' => 'Employees', 'name' => 'employees.activate', 'display_name' => 'Activate Employees'],
            ['feature' => 'Employees', 'name' => 'employees.deactivate', 'display_name' => 'Deactivate Employees'],

            // Roles & Permissions
            ['feature' => 'Roles & Permissions', 'name' => 'roles.view', 'display_name' => 'View Roles'],
            ['feature' => 'Roles & Permissions', 'name' => 'roles.create', 'display_name' => 'Create Roles'],
            ['feature' => 'Roles & Permissions', 'name' => 'roles.edit', 'display_name' => 'Edit Roles'],
            ['feature' => 'Roles & Permissions', 'name' => 'roles.delete', 'display_name' => 'Delete Roles'],
            ['feature' => 'Roles & Permissions', 'name' => 'permissions.view', 'display_name' => 'View Permissions'],
            ['feature' => 'Roles & Permissions', 'name' => 'permissions.assign', 'display_name' => 'Assign Permissions'],

            // Billing
            ['feature' => 'Billing', 'name' => 'billing.view', 'display_name' => 'View Billing'],
            ['feature' => 'Billing', 'name' => 'billing.create', 'display_name' => 'Create Bills'],
            ['feature' => 'Billing', 'name' => 'billing.edit', 'display_name' => 'Edit Bills'],
            ['feature' => 'Billing', 'name' => 'billing.delete', 'display_name' => 'Delete Bills'],
            ['feature' => 'Billing', 'name' => 'billing.payments.view', 'display_name' => 'View Payments'],
            ['feature' => 'Billing', 'name' => 'billing.payments.create', 'display_name' => 'Record Payments'],
            ['feature' => 'Billing', 'name' => 'billing.payments.edit', 'display_name' => 'Edit Payments'],
            ['feature' => 'Billing', 'name' => 'billing.refund', 'display_name' => 'Process Refunds'],

            // Reports
            ['feature' => 'Reports', 'name' => 'reports.view', 'display_name' => 'View Reports'],
            ['feature' => 'Reports', 'name' => 'reports.generate', 'display_name' => 'Generate Reports'],
            ['feature' => 'Reports', 'name' => 'reports.export', 'display_name' => 'Export Reports'],

            // Notifications
            ['feature' => 'Notifications', 'name' => 'notifications.view', 'display_name' => 'View Notifications'],
            ['feature' => 'Notifications', 'name' => 'notifications.send', 'display_name' => 'Send Notifications'],
            ['feature' => 'Notifications', 'name' => 'notifications.sms', 'display_name' => 'Send SMS'],
            ['feature' => 'Notifications', 'name' => 'notifications.whatsapp', 'display_name' => 'Send WhatsApp Messages'],
            ['feature' => 'Notifications', 'name' => 'notifications.email', 'display_name' => 'Send Email'],
            ['feature' => 'Notifications', 'name' => 'notifications.templates.manage', 'display_name' => 'Manage Notification Templates'],

            // Audit
            ['feature' => 'Audit', 'name' => 'audit.view', 'display_name' => 'View Audit Logs'],

            // System
            ['feature' => 'System', 'name' => 'system.view', 'display_name' => 'View System Settings'],
            ['feature' => 'System', 'name' => 'system.settings.edit', 'display_name' => 'Edit System Settings'],
        ];

        foreach ($permissions as $permission) {
            $feature = Feature::where('name', $permission['feature'])->first();

            Permission::updateOrCreate(
                [
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                ],
                [
                    'feature_id' => $feature->id,
                    'display_name' => $permission['display_name'],
                ]
            );
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}