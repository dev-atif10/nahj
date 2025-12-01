<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_admin']); // افترض لديك middleware is_admin
    }

    public function index()
    {
        $permissions = Permission::orderBy('name')->paginate(50);
        return view('admin.permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:permissions,name']);
        Permission::create(['name' => $request->name]);
        return redirect()->route('admin.permissions.index')->with('success','تم إضافة الصلاحية');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success','تم حذف الصلاحية');
    }
}