<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage = 10;

    public function index()
    {
        $usuarios = User::orderBy('email', 'asc')->paginate($this->totalPage);
        return view('pages.usuarios.index')->with('usuarios', $usuarios);
    }

    public function cadastrar() {
        $roles = Role::pluck('name','name')->all();
        return view('pages.usuarios.cadastrar',compact('roles'));
    }

    public function salvar(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $roles = Role::pluck('name','name')->all();
        return redirect()->route('usuarios.index')->with('success','Usuário cadastrado com successo.');
    }

    public function editar($id) {
        $usuario = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $usuario->roles->pluck('name','name')->all();
        return view('pages.usuarios.editar',compact('usuario','roles','userRole'));
    }

    public function atualizar(Request $request, $id) {

        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        } else{
            $input = array_except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index')->with('success','Usuário atualizado com successo.');

    }

    public function deletar($id) {
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            User::find($id)->delete();
            return redirect()->route('usuarios.index')->with('success','Usuário deletado com successo.');

    }

    public function logout() {
        \Auth::logout();
        return redirect()->route('login')->with('message', 'A sessão deste usuário expirou.');
    }

    public function pesquisar(Request $request) {
        $dataForm = $request->except('_token');
        $email = $request->email;

        if (isset($email)) {
            $usuarios = User::where('email','like','%'.$email.'%')
              ->orderBy('email','ASC')
              ->paginate($this->totalPage);
        } else {
            $usuarios = User::orderBy('email','ASC')->paginate($this->totalPage);
        }

        return view('pages.usuarios.index',compact('usuarios'))
        ->with('i', ($request->input('page', 1) - 1) * 5)
        ->with('dataForm',$dataForm);
    }

    public function changePassword()
    {
        $usuario = Auth::user();

        return view('pages.usuarios.perfil', compact('usuario'));
    }

    public function storeChangePassword(Request $request) {

        User::find(Auth::user()->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        return redirect()->route('perfil.changePassword')->with('success','Senha alterada com sucesso.');
        
    }
}
