<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Mostrar listado de usuarios.
     */
    public function index()
    {
        $users = User::with('role')->orderBy('id', 'desc')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Guardar nuevo usuario.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'role_id'  => ['required', 'exists:roles,id'],
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id'  => $validated['role_id'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Mostrar un usuario específico.
     */
    public function show($id)
    {
        $user = User::with(['role', 'sales'])->findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Formulario de edición.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Actualizar usuario.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable', 'min:6'],
            'role_id'  => ['required', 'exists:roles,id'],
        ]);

        $user->update([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password']
                ? Hash::make($validated['password'])
                : $user->password,
            'role_id'  => $validated['role_id'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar usuario.
     */
    public function destroy($id)
    {
        // No permitir eliminar el propio usuario
        if (auth()->id() == $id) {
            return redirect()->route('users.index')
                ->with('error', 'No puedes eliminar tu propio usuario.');
        }

        User::findOrFail($id)->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}