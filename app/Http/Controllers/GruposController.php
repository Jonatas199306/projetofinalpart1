<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class GruposController extends Controller
{
    public function pesquisar(Request $request)
    {
        $totalPage = 10;
        $name =$request->nome;

        if (isset($name)) {
            $roles = Role::where('name','like','%'.$name.'%')
             ->orderBy('name','ASC')
             ->paginate($totalPage);
        } else {
            $roles = Role::orderBy('name','ASC')->paginate($totalPage);
        }
        return view('pages.grupos.index',compact('roles'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id','ASC')->paginate(5);
        return view('pages.grupos.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function cadastrar()
    {
        $permission = Permission::get();
        return view('pages.grupos.cadastrar',compact('permission'));
    }

    public function salvar(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $name = $request->name;
        $role = Role::create(['name' => $name]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('grupos.index')->with('success','Grupo criado com successo');
    }

    public function editar($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('pages.grupos.editar',compact('role','permission','rolePermissions'));
    }

    public function atualizar(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $name = $request->name;
        $role->name = $name;
        $role->save();


        $role->syncPermissions($request->input('permission'));

        return redirect()->route('grupos.index')
                        ->with('success','Grupo atualizado com successo');
    }

    public function deletar($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('grupos.index')->with('success','Grupo deletado com successo');
    }

}
