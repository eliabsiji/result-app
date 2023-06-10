<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'dashboard',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'class-operation-list',
            'add-class-operation',
            'edit-class-operation',
            'delete-class-operation',
            'myclass-list',
            'mysubject-list',
            'class-teacher-list',
            'add-class-teacher',
            'edit-class-teacher',
            'delete-class-teacher',
            'myresultroom-list',
            'myresultroom-creat',
            'myresultroom-edit',
            'myresultroom-delete',
            'parent-list',
            'parent-create',
            'parent-edit',
            'parent-delete',
            'school-arm-list',
            'add-school-arm',
            'edit-school-arm',
            'delete-arm',
            'school-class-list',
            'add-school-class',
            'edit-school-class',
            'delete-school-class',
            'session-list',
            'add-session',
            'edit-session',
            'delete-session',
            'term-list',
            'add-term',
            'edit-term',
            'delete-term',
            'staff-list',
            'add-staff',
            'edit-staff',
            'delete-staff',
            'student-list',
            'add-student',
            'edit-student',
            'delete-student',
            'student-edit',
            'student-delete',
            'studentresults-list',
            'subject-class-list',
            'assign-subject-class',
            'subject-class-edit',
            'subject-class-delete',
            'subject-operation-list',
            'add-subject-operation',
            'edit-subject-operation',
            'delete-subject-operation',
            'subject-list',
            'add-subject',
            'edit-subject',
            'delete-subject',
            'subject-teacher-list',
            'assign-subject-teacher',
            'edit-subject-subject',
            'subject-teacher-delete',
            'view-student-list',
            'academic-operations-list',
            'student-picture-upload',
            'schoolhouse-list',
            'schoolhouse-add',
            'schoolhouse-edit',
            'schoolhouse-delete',
            'classcategory-list',
            'add-classcategory',
            'edit-classcategory',
            'delete-classcategory',
            'add-studenthouse',
            'add-classsettings',
            'delete-classsettings',
        ];

        foreach ($data as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
