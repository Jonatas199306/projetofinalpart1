<?php

namespace App\Http\Controllers;

use App\Services\AfiliadasTiposService;
use Illuminate\Http\Request;
use App\AfiliadasTipo;

class AfiliadasTiposController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage = 10;

    public function index() {
        return view('pages.afiliadas-tipos.index')->with('afiliadasTipos', AfiliadasTiposService::getAll('id', 'ASC', $this->totalPage));
    }

    public function cadastrar() {
        $afiliadasTipo = AfiliadasTipo::all();
        return view('pages.afiliadas-tipos.cadastrar', compact('afiliadasTipo'));
    }

    public function salvar(Request $request) {
        $request->validate(['descricao' => 'required', 'ativa' => 'required']);
        AfiliadasTiposService::save($request->all());
        return redirect()->route('afiliadas-tipos.index')->with('success', 'Afiliada Tipo cadastrada com successo.');
    }

    public function editar($id) {
        $afiliadaTipo = AfiliadasTiposService::get($id);
        return view('pages.afiliadas-tipos.editar', compact('afiliadaTipo'));
    }

    public function atualizar(Request $request, $id) {
        $request->validate(['descricao' => 'required', 'ativa' => 'required']);
        AfiliadasTiposService::update($request->all(), $id);
        return redirect()->route('afiliadas-tipos.index')->with('success', 'Afiliada Tipo atualizada com successo.');

    }

    public function deletar($id) {
        AfiliadasTiposService::delete($id);
        return redirect()->route('afiliadas-tipos.index')->with('success', 'Afiliada Tipo deletada com successo.');

    }

    public function pesquisar(Request $request) {
        $dataForm = $request->except('_token');
        $afiliadasTipos = isset($request->descricao) ? AfiliadasTiposService::findByName($request->descricao, $this->totalPage) : AfiliadasTiposService::getAll('id', 'ASC', $this->totalPage);

        return view('pages.afiliadas-tipos.index', compact('afiliadasTipos'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('dataForm', $dataForm);
    }
}
