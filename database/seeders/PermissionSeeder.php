<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name'  => 'Viwe Users'],
            ['name'  => 'Edit Users'],
            ['name'  => 'View Roles'],
            ['name' =>'Edit Roles'],
            ['name' =>'View Products'],
            ['name' =>  'Edit Products'],
            ['name' => 'View Oders'],
            ['name' => 'Edit Oders'],

        ]);
    }
}
