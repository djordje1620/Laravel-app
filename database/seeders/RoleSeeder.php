<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['korisnik', 'administrator'];

        foreach($roles as $role){
            $roleObj = new Role();
            $roleObj->role = $role;
            $roleObj->save();
        }
    }
}
