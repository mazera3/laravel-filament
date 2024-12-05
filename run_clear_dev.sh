#!/bin/bash
./vendor/bin/sail composer update
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan db:seed --class="PermissionSeeder::class"
./vendor/bin/sail artisan db:seed --class="RoleSeeder::class"
./vendor/bin/sail artisan db:seed --class="UserSeeder::class"
./vendor/bin/sail artisan migrate --force
