<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\{ Permission, Role };
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Roles/Index', [
            'roles' => Role::select(['id', 'name', 'created_at'])->orderBy('name')->get()
                        ->map(fn ($role) => [
                            'id' => $role->id,
                            'name' => $role->name,
                            'created_at' => $role->created_at->diffForHumans(),
                        ]),
            'permissions' => Permission::select(['id','name'])->orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $role = Role::create(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions']);
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role->permissionsAct = $role->permissions()->get()->map(fn ($p) => $p->id);

        return Inertia::render('Roles/Edit', [
            'permissions' => Permission::orderBy('name')->get(),
            'role' => $role,
            'roles' => Role::select(['id', 'name', 'created_at'])->orderBy('name')->get()
                                ->map(fn ($role) => [
                                    'id' => $role->id,
                                    'name' => $role->name,
                                    'created_at' => $role->created_at->diffForHumans(),
                                ]),
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:roles,name,'.$role->id.',id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $role->update(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions']);
        return redirect()->route('roles.index')->with('flash', 'Role modificado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
