# To view the demo
https://acl.xorsoftbd.com/

# For Login
Email: admin@gmail.com
Pass: 123456

# Laravel Role-Based Access Control (RBAC)

This project is a **Laravel application** with **role-based access control** implemented using the [Spatie Laravel Permission](https://github.com/spatie/laravel-permission) package.  
It provides user authentication and authorization with roles and permissions to manage access across different parts of the system.

---

## 🚀 Features
- User authentication (Laravel Breeze / Jetstream / your auth system)
- Role-based access using **Spatie Laravel Permission**
- Assign roles & permissions dynamically
- Middleware protection for routes and controllers
- Example CRUD with role/permission checks
- Database-driven roles & permissions

---

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone https://github.com/razxor/laarvel-Spatie-RBAC.git
cd your-project


2. Install Dependencies
composer install
npm install && npm run dev

3. Environment Setup

Copy .env.example to .env and update your database and mail configuration:

cp .env.example .env
php artisan key:generate

4. Run Migrations & Seed
php artisan migrate --seed


The seeder will create default roles and an admin user (update DatabaseSeeder.php accordingly).

🔑 Authentication & Authorization
Install Spatie Permission

This project already uses the package:

composer require spatie/laravel-permission


Publish and run migration:

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate

👥 Roles & Permissions
Creating Roles
use Spatie\Permission\Models\Role;

Role::create(['name' => 'admin']);
Role::create(['name' => 'editor']);
Role::create(['name' => 'user']);

Creating Permissions
use Spatie\Permission\Models\Permission;

Permission::create(['name' => 'create articles']);
Permission::create(['name' => 'edit articles']);
Permission::create(['name' => 'delete articles']);

Assigning Roles/Permissions to Users
$user = User::find(1);
$user->assignRole('admin');
$user->givePermissionTo('edit articles');

🔒 Middleware Protection

Add middleware to routes/web.php:

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

Route::group(['middleware' => ['permission:edit articles']], function () {
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit']);
});

📂 Project Structure (Auth + RBAC parts)
app/
 └── Models/
     └── User.php  # Uses HasRoles trait
 └── Http/
     └── Middleware/
         └── EnsureRoleOrPermission.php (custom if needed)

database/
 └── seeders/
     └── RolePermissionSeeder.php

🧑‍💻 Example: User Model
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}

🧪 Testing Access
$user->hasRole('admin');             // true/false
$user->can('edit articles');         // true/false
$user->getRoleNames();               // ['admin']
$user->getAllPermissions();          // collection