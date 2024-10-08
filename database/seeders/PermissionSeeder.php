<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionList = [
            // home page
            [
                'name' => "home-show",
                'info' => "Главная страница",
            ],
            [
                'name' => 'home-index',
                'info' => "Главная страница",
            ],
            [
                'name' => 'home-profile',
                'info' => "Профиль",
            ],
            // permission page
            [
                'name' => 'permission-show',
                'info' => "Разрешение (показать)",
            ],
            [
                'name' => 'permission-index',
                'info' => "Разрешение (лист)",
            ],
            [
                'name' => 'permission-create',
                'info' => "Разрешение (создать)",
            ],
            [
                'name' => 'permission-store',
                'info' => "Разрешение (сохранить)",
            ],
            [
                'name' => 'permission-edit',
                'info' => "Разрешение (редоктировать)",
            ],
            [
                'name' => 'permission-update',
                'info' => "Разрешение (редоктировать 2)",
            ],
            [
                'name' => 'permission-destroy',
                'info' => "Разрешение (удалит)",
            ],
            // role page
            [
                'name' => 'role-index',
                'info' => "Роли (лист)",
            ],
            [
                'name' => 'role-filter',
                'info' => "Роли (фильтр)",
            ],
            [
                'name' => 'role-show',
                'info' => "Роли (показать)",
            ],
            [
                'name' => 'role-create',
                'info' => "Роли (создать)",
            ],
            [
                'name' => 'role-store',
                'info' => "Роли (сохранит)",
            ],
            [
                'name' => 'role-edit',
                'info' => "Роли (редоктировать)",
            ],
            [
                'name' => 'role-update',
                'info' => "Роли (редоктировать 2)",
            ],
            [
                'name' => 'role-destroy',
                'info' => "Роли (удалит)",
            ],
            // user page
            [
                'name' => 'user-index',
                'info' => "Пользователи (лист)",
            ],
            [
                'name' => 'user-filter',
                'info' => "Пользователи (фильтр)",
            ],
            [
                'name' => 'user-create',
                'info' => "Пользователи (создать)",
            ],
            [
                'name' => 'user-store',
                'info' => "Пользователи (сохранит)",
            ],
            [
                'name' => 'user-show',
                'info' => "Пользователи (показать)",
            ],
            [
                'name' => 'user-edit',
                'info' => "Пользователи (редоктировать)",
            ],
            [
                'name' => 'user-update',
                'info' => "Пользователи (редоктировать 2)",
            ],
            [
                'name' => 'user-destroy',
                'info' => "Пользователи (удалить)",
            ],
            // employee
            [
                'name' => 'employee-index',
                'info' => "Сотрудники (лист)",
            ],
            [
                'name' => 'employee-filter',
                'info' => "Сотрудники (фильтр)",
            ],
            [
                'name' => 'employee-show',
                'info' => "Сотрудники (показать)",
            ],
            [
                'name' => 'employee-create',
                'info' => "Сотрудники (создать)",
            ],
            [
                'name' => 'employee-store',
                'info' => "Сотрудники (сохранить)",
            ],
            [

                'name' => 'employee-edit',
                'info' => "Сотрудники (редоктировать)",
            ],
            [
                'name' => 'employee-update',
                'info' => "Сотрудники (редоктировать)",
            ],
            [
                'name' => 'employee-destroy',
                'info' => "Сотрудники (удалить)",
            ],
            [
                'name' => 'employee-change-template',
                'info' => "Изменение время работы сотрудника по шаблону",
            ],
            [
                'name' => 'employee-change-template-submit',
                'info' => "Изменение время работы сотрудника по шаблону (сохранить)",
            ],
            [
                'name' => 'employee-change-individual',
                'info' => "Изменение время работы сотрудника индивидуально",
            ],
            [
                'name' => 'employee-change-individual-submit',
                'info' => "Изменение время работы сотрудника индивидуально (сохранить)",
            ],
            [
                'name' => 'employee-download_file',
                'info' => "",
            ],
            [
                'name' => 'employee-change_individual',
                'info' => "",
            ],
            [
                'name' => 'employee-change-working-hours',
                'info' => "Изменение время работы сотрудника (П)",
            ],
            // Position
            [
                'name' => 'position-index',
                'info' => "Должность",
            ],
            [
                'name' => 'position-filter',
                'info' => "Должность (фильтр)",
            ],
            [
                'name' => 'position-show',
                'info' => "Должность (показать)",
            ],
            [
                'name' => 'position-create',
                'info' => "Должность (создать)",
            ],
            [
                'name' => 'position-store',
                'info' => "Должность (сохранить)",
            ],
            [
                'name' => 'position-edit',
                'info' => "Должность (редоктировать)",
            ],
            [
                'name' => 'position-update',
                'info' => "Должность (редоктировать 2)",
            ],
            [
                'name' => 'position-destroy',
                'info' => "Должность (удалить)",
            ],
            // Department
            [
                'name' => 'department-index',
                'info' => "Отдел",
            ],
            [
                'name' => 'department-filter',
                'info' => "Отдел (фильтр)",
            ],
            [
                'name' => 'department-show',
                'info' => "Отдел (показать)",
            ],
            [
                'name' => 'department-create',
                'info' => "Отдел (создать)",
            ],
            [
                'name' => 'department-store',
                'info' => "Отдел (сохранить)",
            ],
            [
                'name' => 'department-edit',
                'info' => "Отдел (редоктировать)",
            ],
            [
                'name' => 'department-update',
                'info' => "Отдел (редоктировать 2)",
            ],
            [
                'name' => 'department-destroy',
                'info' => "Отдел (удалить)",
            ],
            // TT
            [
                'name' => 'tt-index',
                'info' => "Время прихода/ухода",
            ],
            [
                'name' => 'tt-filter',
                'info' => "Время прихода/ухода (фильтр)",
            ],
            [
                'name' => 'tt-show',
                'info' => "Время прихода/ухода (показать)",
            ],
            [
                'name' => 'tt-create',
                'info' => "Время прихода/ухода (создать)",
            ],
            [
                'name' => 'tt-store',
                'info' => "Время прихода/ухода (сохранить)",
            ],
            [
                'name' => 'tt-edit',
                'info' => "Время прихода/ухода (редоктировать)",
            ],
            [
                'name' => 'tt-update',
                'info' => "Время прихода/ухода (редоктировать 2)",
            ],
            [
                'name' => 'tt-destroy',
                'info' => "Время прихода/ухода (удалить)",
            ],
            // Cadre
            [
                'name' => 'cadre-index',
                'info' => "Страница кадра",
            ],
            [
                'name' => 'cadre-filter',
                'info' => "Страница кадра (фильтр)",
            ],
            [
                'name' => 'cadre-show',
                'info' => "Страница кадра (показать)",
            ],
            [
                'name' => 'cadre-create',
                'info' => "Страница кадра (создать)",
            ],
            [
                'name' => 'cadre-store',
                'info' => "Страница кадра (сохранить)",
            ],
            [
                'name' => 'cadre-edit',
                'info' => "Страница кадра (редоктировать)",
            ],
            [
                'name' => 'cadre-update',
                'info' => "Страница кадра (редоктировать 2)",
            ],
            [
                'name' => 'cadre-destroy',
                'info' => "Страница кадра (удалить)",
            ],
            [
                'name' => 'cadre-changeStatus',
                'info' => "Страница кадра (изменение статуса)",
            ],
            [
                'name' => 'cadre-report',
                'info' => "Страница кадра (отчет)",
            ],
            [
                'name' => 'cadre-weekend',
                'info' => "Страница кадра (выходные)",
            ],
            [
                'name' => 'cadre-all',
                'info' => "Страница кадра (все)",
            ],
            // Bugalter
            [
                'name' => 'bugalter-index',
                'info' => "",
            ],
            [
                'name' => 'bugalter-filter',
                'info' => "",
            ],
            [
                'name' => 'bugalter-show',
                'info' => "",
            ],
            [
                'name' => 'bugalter-create',
                'info' => "",
            ],
            [
                'name' => 'bugalter-store',
                'info' => "",
            ],
            [
                'name' => 'bugalter-edit',
                'info' => "",
            ],
            [
                'name' => 'bugalter-update',
                'info' => "",
            ],
            [
                'name' => 'bugalter-destroy',
                'info' => "",
            ],
            // Holiday
            [
                'name' => 'holiday-index',
                'info' => "Выходные",
            ],
            [
                'name' => 'holiday-filter',
                'info' => "Выходные (фильтр)",
            ],
            [
                'name' => 'holiday-show',
                'info' => "Выходные (показать)",
            ],
            [
                'name' => 'holiday-create',
                'info' => "Выходные (создать)",
            ],
            [
                'name' => 'holiday-store',
                'info' => "Выходные (сохранить)",
            ],
            [
                'name' => 'holiday-edit',
                'info' => "Выходные (редоктировать)",
            ],
            [
                'name' => 'holiday-update',
                'info' => "Выходные (редоктировать 2)",
            ],
            [
                'name' => 'holiday-destroy',
                'info' => "Выходные (удалить)",
            ],
            // Change Hours
            [
                'name' => 'changehour-index',
                'info' => "Изменение время работы сотрудника [подтверждение]",
            ],
            [
                'name' => 'changehour-allow',
                'info' => "Изменение время работы сотрудника [подтверждение] (пдтвердить)",
            ],
            [
                'name' => 'changehour-cancel',
                'info' => "Изменение время работы сотрудника [подтверждение] (отменить)",
            ],
            // Weekend
            [
                'name' => 'weekend-index',
                'info' => "Выходные",
            ],
            [
                'name' => 'weekend-allow',
                'info' => "Выходные (пдтвердить)",
            ],
            [
                'name' => 'weekend-cancel',
                'info' => "Выходные (отменить)",
            ],
            // Bs
            [
                'name' => 'bs-index',
                'info' => "",
            ],
            [
                'name' => 'bs-filter',
                'info' => "",
            ],
            [
                'name' => 'bs-show',
                'info' => "",
            ],
            [
                'name' => 'bs-create',
                'info' => "",
            ],
            [
                'name' => 'bs-store',
                'info' => "",
            ],
            [
                'name' => 'bs-edit',
                'info' => "",
            ],
            [
                'name' => 'bs-update',
                'info' => "",
            ],
            [
                'name' => 'bs-destroy',
                'info' => "",
            ],
        ];
        foreach ($permissionList as $item => $value){
            Permission::updateOrCreate([
                'name' => $value['name'],
            ], [
                'info' => $value['info']
            ]);
        }
    }
}
