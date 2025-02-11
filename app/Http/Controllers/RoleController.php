<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



// use App\Http\Controllers\RoleController::middleware();

use Illuminate\Routing\Controller as BaseController;

class RoleController extends BaseController
// class RoleController extends Controller
{
    public  function __construct()
    {
        $this->middleware('permission:create role', ['only' => ['create']]);
    }
    public function index()
    {
        $roles = Role::get();
        return view('role-permission.role.index', [
            'roles' => $roles
        ]);
    }
    public function create()
    {
        return view('role-permission.role.create');

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name']
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect( route('role.index') )->with('status', 'Role Created Successfully');
    }
    public function edit(Role $role)
    {
        return view('role-permission.role.edit', [
            'role' => $role
        ]);

    }
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id // Correct syntax
            ],
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('role.index')->with('status', 'Role Updated Successfully');
    }

    public function destroy($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();
        return redirect()->route('role.index')->with('status', 'Role Deleted Successfully');

        
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                ->all();

        return view('role-permission.role.add-permission', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status','Permissions Added to Role Successfully');
    }
}
