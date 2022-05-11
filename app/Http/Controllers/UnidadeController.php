<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Services\UnidadesService;
use Illuminate\Http\Request;
use App\Unidade;

class UnidadeController extends Controller
{
    private $totalPage = 10;

    public function index(Request $request) {
        
        return view('pages.unidades.index')->with('unidades', UnidadesService::getAll('id', 'ASC', $this->totalPage, $request));
    }

    public function cadastrar() {
        return view('pages.unidades.cadastrar');
    }

    public function editar($id) {
        $unidade = UnidadesService::get($id);
        return view('pages.unidades.editar',compact('unidade'));
    }

    public function salvar(Request $request) {
        $request->validate([
            'cnpj' => 'required',
            'nome' => 'required',
            'sigla' => 'required',
            'tipo' => 'required',
            'taxa_administrativa' => 'required'
        ]);

        UnidadesService::save($request->all());
        return redirect()->route('unidades.index')->with('success','Unidade cadastrada com successo.');
    }


    public function atualizar(Request $request, $id) {
        $request->validate([
            'cnpj' => 'required',
            'nome' => 'required',
            'sigla' => 'required',
            'tipo' => 'required',
            'taxa_administrativa' => 'required'
        ]);
        $input = $request->all();
        $input = array_except($input, ['_token']);
        $input['cnpj'] = Helper::rmSpecialChars($input['cnpj']);
        $input['telefone'] = Helper::rmSpecialChars($input['telefone']);
        $input['celular'] = Helper::rmSpecialChars($input['celular']);
        $input['cep'] = Helper::rmSpecialChars($input['cep']);


        Unidade::where('id', $id)->update($input);
        return redirect()->route('unidades.index')->with('success','Unidade atualizada com successo.');
    }


    public function deletar($id) {
        Unidade::find($id)->delete();
        return redirect()->route('unidades.index')->with('success','Unidade deletada com successo.');
    }
}
