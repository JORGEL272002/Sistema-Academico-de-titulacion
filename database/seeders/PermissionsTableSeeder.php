<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // ==== PERMISOS ====
            'permisos' => [
                'permiso.index',
                'permiso.create',
                'permiso.update',
                'permiso.delete',
            ],
            // ==== USUARIOS ====
            'usuarios' => [
                'usuario.index',
                'usuario.view',
                'usuario.create',
                'usuario.update',
                'usuario.delete',
            ],

            // ==== PLANTEL ADMINISTRATIVO ====
            'plantel_administrativo' => [
                'plantel_administrativo.index',
            ],

            // ==== DOCENTES ====
            'docentes' => [
                'docente.index',
            ],

            // ==== ESTUDIANTE ====
            'estudiante' => [
                'estudiante.index',
            ],

            // ==== PROGRAMA ACADÉMICO ====
            'programa_academico' => [
                'programa_academico.index',
                'programa_academico.view',
                'programa_academico.create',
                'programa_academico.update',
                'programa_academico.delete',
            ],

            // ==== PROYECTO ====
            'proyecto' => [
                'proyecto.index',
                'proyecto.view',
                'proyecto.revision',
                'proyecto.create',
                'proyecto.update',
                'proyecto.delete',
            ],

            // // ==== METODOLOGIA ====
            // 'metodologia' => [
            //     'metodologia.index',
            //     'metodologia.view',
            //     'metodologia.create',
            //     'metodologia.update',
            //     'metodologia.delete',
            // ],


            // // ==== MODULO ====
            // 'modulo' => [
            //     'modulo.index',
            //     'modulo.view',
            //     'modulo.create',
            //     'modulo.update',
            //     'modulo.delete',
            // ],

            // // ==== PAGO ====
            // 'pago' => [
            //     'pago.index',
            //     'pago.view',
            //     'pago.create',
            //     'pago.update',
            //     'pago.delete',
            // ],

            // // ==== TALLER ====
            // 'taller' => [
            //     'taller.index',
            //     'taller.view',
            //     'taller.create',
            //     'taller.update',
            //     'taller.delete',
            // ],

            // // ==== AVANCE ESTUDIANTE ====
            // 'avance_estudiante' => [
            //     'avance_estudiante.index',
            //     'avance_estudiante.view',
            //     'avance_estudiante.create',
            //     'avance_estudiante.update',
            //     'avance_estudiante.delete',
            // ],

        ];


        $insert_data = [];
        $time_stamp = Carbon::now()->toDateTimeString();

        // Flatten and insert the permissions
        foreach ($data as $permissions) {
            foreach ($permissions as $permission) {
                $insert_data[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => $time_stamp,
                    'updated_at' => $time_stamp
                ];
            }
        }

        Permission::insert($insert_data);
    }
}
