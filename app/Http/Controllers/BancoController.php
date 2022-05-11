<?php

namespace App\Http\Controllers;

use App\Services\BancoService;
use Illuminate\Http\Request;

class BancoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage = 10;

    public function index() {
        return view('pages.bancos.index')->with('bancos', BancoService::getAll('id', 'ASC', $this->totalPage));
    }

    public function cadastrar() {
        return view('pages.bancos.cadastrar');
    }

    public function salvar(Request $request) {
        $request->validate(['nome' => 'required', 'ativo' => 'required']);
        BancoService::save($request->all());
        return redirect()->route('bancos.index')->with('success', 'Banco cadastrado com successo.');
    }

    public function editar($id) {
        $banco = BancoService::get($id);
        return view('pages.bancos.editar', compact('banco'));
    }

    public function atualizar(Request $request, $id) {
        $request->validate(['nome' => 'required', 'ativo' => 'required']);
        BancoService::update($request->all(), $id);
        return redirect()->route('bancos.index')->with('success', 'Banco atualizado com successo.');

    }

    public function deletar($id) {
        BancoService::delete($id);
        return redirect()->route('bancos.index')->with('success', 'Banco deletado com successo.');

    }

    public function pesquisar(Request $request) {
        $dataForm = $request->except('_token');
        $bancos = isset($request->nome) ? BancoService::findByName($request->nome, $this->totalPage) : BancoService::getAll('id', 'ASC', $this->totalPage);

        return view('pages.bancos.index', compact('bancos'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('dataForm', $dataForm);
    }
}
