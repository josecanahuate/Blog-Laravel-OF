<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.roles.index')->only(['index']);
        $this->middleware('can:admin.roles.create')->only(['create', 'store']);
        $this->middleware('can:admin.roles.edit')->only(['edit', 'update']);
        $this->middleware('can:admin.roles.destroy')->only(['destroy']);
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        //validacion
        $request->validate([
            'name' => 'required'
        ]);
        
        //crea un nuevo rol
        $role = Role::create($request->all());

        //asignar y sincronizar permisos con el rol
        $role->permissions()->sync($request->permissions);
        return redirect(route('admin.roles.edit', $role))->with('info', 'El rol se creó correctamente');
    }


    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }


    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));

    }


    public function update(Request $request, Role $role)
    {
        //validacion
        $request->validate([
            'name' => 'required'
        ]);
        
        //actualizar rol
        $role->update($request->all());

        //asignar y sincronizar permisos con el rol
        $role->permissions()->sync($request->permissions);
        return redirect(route('admin.roles.index', $role))->with('info', 'El rol se actualizó correctamente');

    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect(route('admin.roles.index', $role))->with('info', 'El rol se eliminó correctamente');
    }
}
