<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only(['index']);
        $this->middleware('can:admin.users.create')->only(['create', 'store']);
        $this->middleware('can:admin.users.edit')->only(['edit', 'update']);
        $this->middleware('can:admin.users.destroy')->only(['destroy']);
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function create(){
        $roles = Role::all(); // Recuperando los roles
        return view('admin.users.create', compact('roles'));
    }
    
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        // Crea un nuevo usuario con los datos proporcionados
         $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        ]);

        // Asignar rol al nuevo usuario
        $user->roles()->sync($request->roles);

        // Redirecciona a alguna página después de la creación exitosa
        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente');  
    }

    public function edit(User $user)
    {
        $roles = Role::all(); //recuperando los roles
        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.index', $user)->with('info', 'Se asignaron los roles correctamente');
    }


    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.users.index', $user)->with('info', 'El usuario ha sido eliminado con exito!');
    }

}
