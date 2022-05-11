<?php

namespace App\Http\Controllers;

use App\Services\AfiliadasService;
use Illuminate\Http\Request;
use App\AfiliadasTipo;

class AfiliadasController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage = 10;

    public function index(Request $request) {
        return view('pages.afiliadas.index')->with('afiliadas', AfiliadasService::getAll('id', 'ASC', $this->totalPage, $request));
    }

    public function cadastrar() {
        $afiliadas_tipos = AfiliadasTipo::all();
        $unidades = AfiliadasService::getAllUnidades();
        return view('pages.afiliadas.cadastrar', compact('unidades', 'afiliadas_tipos'));
    }

    public function salvar(Request $request) {
        $request->validate([
            'nome' => 'required',
            'cnpj' => 'required|unique:afiliadas',
            'unidades_id' => 'required|exists:unidades,id',
            'sigla' => 'required',
            'afiliadas_tipo_id' => 'required',
            'filiacao' => 'required',
            'ativa' => 'required',
            'taxa_administrativa' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
        ]);

        AfiliadasService::save($request->all());
        return redirect()->route('afiliadas.index')->with('success', 'Afiliada cadastrada com successo.');
    }

    public function editar($id) {
        $afiliadas_tipos = AfiliadasTipo::all();
        $afiliada = AfiliadasService::get($id);
        $unidades = AfiliadasService::getAllUnidades();
        return view('pages.afiliadas.editar', compact('afiliada', 'unidades', 'afiliadas_tipos'));
    }

    public function atualizar(Request $request, $id) {
        $request->validate([
            'nome' => 'required',
            'cnpj' => 'required',
            'unidades_id' => 'required',
            'sigla' => 'required',
            'afiliadas_tipo_id' => 'required',
            'filiacao' => 'required',
            'ativa' => 'required',
            'taxa_administrativa' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required'
        ]);

        AfiliadasService::update($request->all(), $id);
        return redirect()->route('afiliadas.index')->with('success', 'Afiliada atualizada com successo.');

    }

    public function deletar($id) {
        AfiliadasService::delete($id);
        return redirect()->route('afiliadas.index')->with('success', 'Afiliada deletada com successo.');
    }
}
