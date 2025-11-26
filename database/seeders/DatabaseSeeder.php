<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionsTableSeeder::class);

        $usuario = User::factory()->create([
            'nombres' => 'Admin',
            'apellidos' => 'System',
            'carnet' => '0000000',
            'tipo_usuario' => 'administrador',
            'status' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $role = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'start_path' => 'inicio',
            'is_default' => 1,
        ]);
        $usuario->assignRole($role->name);


    }
}
