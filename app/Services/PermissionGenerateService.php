<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Support\Facades\Route;

class PermissionGenerateService
{
    public function handle()
    {
        $routesNames = Route::getRoutes()->getRoutesByName();

        $mapListRoutes = array_map(
            function ($routeName) {
                return str_contains($routeName, 'filament.admin.') ? $routeName : null;
            },
            array_keys($routesNames)
        );
        $routesPermissions = array_filter($mapListRoutes);

        // dd($routesPermissions);

        foreach ($routesPermissions as $permission) {
            $default = false;
            if (in_array($permission, $this->defaultsPermissions())) {
                $default = true;
            }

            Permission::updateOrCreate([
                'name' => $permission,
            ], [
                "description" => $this->extractDescription($permission),
                "group" => $this->extractGroup($permission),
                "default" => $default,
            ]);
        }
    }

    protected function extractDescription(string $routeName): string
    {
        $entity = $this->translate($routeName);

        if (str_contains($routeName, 'index')) {
            return "Lista de {$entity}";
        }

        if (str_contains($routeName, 'create')) {
            return "Criação de {$entity}";
        }

        if (str_contains($routeName, 'edit')) {
            return "Edição de {$entity}";
        }

        if (str_contains($routeName, 'delete')) {
            return "Exclusão de {$entity}";
        }

        if (str_contains($routeName, 'register')) {
            return "Criação de {$entity}";
        }

        return "no description";
    }

    protected function extractGroup(string $routeName): string
    {
        return "Grupo de " . $this->translate($routeName);
    }

    protected function translate(string $routeName)
    {
        $separate = explode(".", $routeName);
        $entity = $separate[3];

        if (str_contains($entity, "users")) {
            $entity = "Usuários";
        }

        if (str_contains($entity, "roles")) {
            $entity = "Funções";
        }

        if (str_contains($entity, "register")) {
            $entity = "Registros";
        }

        if (str_contains($entity, "permissions")) {
            $entity = "Permissões";
        }
        return ucfirst($entity);
    }

    protected function defaultsPermissions(): array
    {
        return [
            "filament.admin.pages.dashboard",
        ];
    }
}
