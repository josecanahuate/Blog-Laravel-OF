<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //roles
        $role1 = Role::create(["name" => "Admin"]);
        $role2 = Role::create(["name" => "Blogger"]);

        Permission::create(['name' => 'admin.home', 'description' => 'Ver Dashboard'])->syncRoles([$role1, $role2]);

        //permisos de admin CRUD
        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Asignar Rol'])->syncRoles([$role1]);

        //permisos de admin Roles
        Permission::create(['name' => 'admin.roles.index', 'description' => 'Ver Rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.create', 'description' => 'Crear Rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit', 'description' => 'Editar Rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.destroy', 'description' => 'Eliminar Rol'])->syncRoles([$role1]);
      
        //permisos para proteger las categorias
        Permission::create(['name' => 'admin.categories.index', 'description' => 'Ver Categorías'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.create', 'description' => 'Crear Categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit', 'description' => 'Editar Categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy', 'description' => 'Eliminar Categorías'])->syncRoles([$role1]);

        //permisos para proteger las etiquetas
        Permission::create(['name' => 'admin.tags.index', 'description'=> 'Ver Etiquetas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tags.create', 'description'=> 'Crear Etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.edit', 'description'=> 'Editar Etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy', 'description'=> 'Eliminar Etiquetas'])->syncRoles([$role1]);

        //permisos para proteger los posts
        Permission::create(['name' => 'admin.posts.index', 'description' => 'Ver Posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create', 'description'=> 'Crear Posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit', 'description'=> 'Editar Posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy', 'description'=> 'Eliminar Posts'])->syncRoles([$role1, $role2]);

    }
}
