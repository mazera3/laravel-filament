# Vídeos
Lista: https://www.youtube.com/watch?v=N6lvrINJljA&list=PLzKPnb4PnS-Kfet03vds8M3zko1TcCpKs&index=2
1. https://youtu.be/g88ByU0nMZc?si=bV0bJNczhpOTAf6C
2. https://youtu.be/N6lvrINJljA?si=qwgXQhn9u26glRPs

# Instale o composer no linux
* /bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.3)"
* composer global require laravel/installer

#  Instalação do Laravel
```sh
laravel new laravel_filament
[mysql, PHPUnit, não rodar migrate]
- npm install
- npm run build
- composer run dev
- Documentação: [https://laravel.com/docs/11.x/sail#installing-sail-into-existing-applications](Sail)
```
# Intalar o sail
```sh
php artisan sail:install [mysql, redis, mailpit]
```
# .env
```sh
cp .env.example .env
# adicionar
APP_PORT=8012
VITE_PORT=5112
FORWARD_DB_PORT=3612
FORWARD_REDIS_PORT=6312
FORWARD_MAILPIT_PORT=1012
FORWARD_MAILPIT_DASHBOARD_PORT=7012
# para evitar erro de banco de dados
SESSION_DRIVER=file #database
QUEUE_CONNECTION=redis #database
CACHE_STORE=null #database
```
```sh
# Configurando um Shell Alias
#  adicionar esta linha ao arquivo de configuração shell como ~/.bashrc e reinicie o shell.
nano ~/.bashrc
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
sail up -d
```
# Filament
## https://filamentphp.com/docs/3.x/panels/installation
```sh
sail composer require filament/filament:"^3.2" -W
sail artisan filament:install --panels # app/Providers/Filament/AdminPanelProvider.php
sail artisan migrate
sail artisan make:filament-user
```
# Menu admin
- topNavigation()

# Resourse
```sh
sail artisan make:filament-resource User --generate # --soft-deletes # app/Filament/Resources/UserResource.php
```
## Editando o AdminPanelProvider
```sh
# para deixar o painel na horizontal
- ->topNavigation()
# para registrar um novo usuario no login:
- ->registration() 
```
# Criando Models e Migration
```sh
sail artisan make:migration create_roles_table --create=roles # cria a migration com a tabela roles e duplica para use_roles.
sail artisan migrate
sail artisan make:model Role # cria app/Models/Roles
```
# Criar Resource
```sh
sail artisan make:filament-resource Role --generate # app/Filament/Resources/RoleResource.php
```
# Gerar seed
```sh
sail artisan make:seeder UserSeeder
sail artisan make:seeder RoleSeeder
sail artisan migrate:fresh --seed