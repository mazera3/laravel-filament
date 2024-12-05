<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $roles = [

            [
                'name'      => "Admin",
                "description" => "Admin do Sistema",
                "active"  => 1,
                'system'    => 1,
            ],
            [
                'name'      => "User",
                "description" => "Usuário do Sistema",
                "active"  => 1,
                'system'    => 1,
            ],
        ];
        foreach ($roles as $role) {
            Role::updateOrCreate(
                [
                    'name' => $role["name"],
                ],
                [
                    'description' => $role["description"],
                    'active' => $role["active"],
                    'system' => $role["system"],
                ]
            );
        }
    }
}
