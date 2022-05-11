<?php

namespace App\Http\Controllers;

use App\Services\AssociadoService;
use Illuminate\Http\Request;

class AssociadoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage = 10;

    public function index(Request $request) {
        return view('pages.associados.index')->with('associados', AssociadoService::getAll('beneficio', 'ASC', $this->totalPage, $request));
    }

    public function cadastrar() {
        $afiliadas = AssociadoService::getAllAfiliadas();
        $especies = AssociadoService::getAllEspecies();
        return view('pages.associados.cadastrar', compact('afiliadas', 'especies'));
    }

    public function salvar(Request $request) {
        $request->cpf = $this->sNumber($request->cpf);
        $request->validate([
            'beneficio' => 'required|string|unique:associados,beneficio',
            'afiliadas_id' => 'required|exists:afiliadas,id',
            'nome' => 'required|string',
            'cpf' => 'required|unique:associados,cpf',
            'nascimento' => 'required|date',
            'ativo' => 'required|string',
            'admissao' => 'required|date',
            'desconto' => 'required|numeric',
            'ficha_autorizacao' => 'required|string'
        ]);

        AssociadoService::save($request->all());
        return redirect()->route('associados.index')->with('success', 'Associado cadastrado com successo.');
    }

    public function editar($beneficio) {
        $associado = AssociadoService::get($beneficio);
        $afiliadas = AssociadoService::getAllAfiliadas();
        $especies = AssociadoService::getAllEspecies();
        return view('pages.associados.editar', compact('associado', 'afiliadas','especies'));
    }

    public function atualizar(Request $request, $beneficio) {
        $request->cpf = $this->sNumber($request->cpf);
        $request->validate([
            'beneficio' => 'required|string|unique:App\\Associado,beneficio,' . $beneficio,
            'afiliadas_id' => 'required|exists:afiliadas,id',
            'nome' => 'required|string',
            'cpf' => 'required|unique:App\\Associado,cpf,' . $beneficio,
            'nascimento' => 'required|date',
            'ativo' => 'required|string',
            'admissao' => 'required|date',
            'desconto' => 'required|numeric',
            'ficha_autorizacao' => 'required|string'
        ]);

        AssociadoService::update($request->all(), $beneficio);
        return redirect()->route('associados.index')->with('success', 'Associado atualizado com successo.');

    }

    public function deletar($beneficio) {
        AssociadoService::delete($beneficio);
        return redirect()->route('associados.index')->with('success', 'Associado deletado com successo.');

    }

    public function sNumber($string){
        return preg_replace("/[^0-9]/", "", $string);
    }
}
