<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $role1 = Role::create(['name'=>'Admin']);
     $role2 = Role::create(['name'=>'Blogger']);



     Permission::create(['name' => 'livewire.programas.index'])->syncRoles([$role1]);
     Permission::create(['name' => 'livewire.jornadas.index'])->syncRoles([$role1]);


    }
}
