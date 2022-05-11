<?php

namespace App\Http\Controllers;

use App\Services\ContaBancariaService;
use Illuminate\Http\Request;

class ContaBancariaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage = 10;

    public function index() {
        return view('pages.contas-bancarias.index')->with('contasBancarias', ContaBancariaService::getAll('id', 'ASC', $this->totalPage));
    }

    public function cadastrar() {
        $unidades = ContaBancariaService::getAllUnidades();
        $bancos = ContaBancariaService::getAllBancos();
        return view('pages.contas-bancarias.cadastrar', compact('unidades', 'bancos'));
    }

    public function salvar(Request $request) {
        $request->validate([
            'unidades_id' => 'required|exists:unidades,id',
            'favorecido' => 'required|string',
            'favorecido_cnpj' => 'required|string',
            'banco' => 'required|string',
            'agencia' => 'required|string',
            'conta' => 'required|string',
            'ativa' => 'required|string'
        ]);
        ContaBancariaService::save($request->all());
        return redirect()->route('contas-bancarias.index')->with('success', 'Conta Bancária cadastrada com successo.');
    }

    public function editar($id) {
        $contaBancaria = ContaBancariaService::get($id);
        $unidades = ContaBancariaService::getAllUnidades();
        $bancos = ContaBancariaService::getAllBancos();
        return view('pages.contas-bancarias.editar', compact('contaBancaria', 'unidades', 'bancos'));
    }

    public function atualizar(Request $request, $id) {
        $request->validate([
            'unidades_id' => 'required|exists:unidades,id',
            'favorecido' => 'required|string',
            'favorecido_cnpj' => 'required|string',
            'banco' => 'required|string',
            'agencia' => 'required|string',
            'conta' => 'required|string',
            'ativa' => 'required|string'
        ]);
        ContaBancariaService::update($request->all(), $id);
        return redirect()->route('contas-bancarias.index')->with('success', 'Conta Bancária atualizada com successo.');

    }

    public function deletar($id) {
        ContaBancariaService::delete($id);
        return redirect()->route('contas-bancarias.index')->with('success', 'Conta Bancária deletada com successo.');

    }

    public function pesquisar(Request $request) {
        $dataForm = $request->except('_token');
        $contasBancarias = isset($request->favorecido) ? ContaBancariaService::findByName($request->favorecido, $this->totalPage) : ContaBancariaService::getAll('id', 'ASC', $this->totalPage);

        return view('pages.contas-bancarias.index', compact('contasBancarias'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('dataForm', $dataForm);
    }
}
