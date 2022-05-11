<?php

namespace App\Http\Controllers;

use App\Afiliadas;
use App\Services\AfiliadasContatoService;
use Illuminate\Http\Request;
use App\AfiliadasContato;

class AfiliadasContatoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $totalPage = 10;

    public function index() {
        return view('pages.afiliadas-contatos.index')->with('afiliadasContatos', AfiliadasContatoService::getAll('id', 'ASC', $this->totalPage));
    }

    public function cadastrar() {
        $afiliadasContato = AfiliadasContato::all();
        $afiliadas = Afiliadas::all();
        return view('pages.afiliadas-contatos.cadastrar', compact('afiliadasContato', 'afiliadas'));
    }

    public function salvar(Request $request) {
        $request->validate(['nome' => 'required', 'telefone' => 'required', 'afiliadas_id' => 'required|exists:afiliadas,id']);
        AfiliadasContatoService::save($request->all());
        return redirect()->route('afiliadas-contatos.index')->with('success', 'Afiliada Contato cadastrada com successo.');
    }

    public function editar($id) {
        $afiliadaContato = AfiliadasContatoService::get($id);
        $afiliadas = Afiliadas::all();
        return view('pages.afiliadas-contatos.editar', compact('afiliadaContato', 'afiliadas'));
    }

    public function atualizar(Request $request, $id) {
        $request->validate(['nome' => 'required', 'telefone' => 'required', 'afiliadas_id' => 'required|exists:afiliadas,id']);
        AfiliadasContatoService::update($request->all(), $id);
        return redirect()->route('afiliadas-contatos.index')->with('success', 'Afiliada Contato atualizada com successo.');

    }

    public function deletar($id) {
        AfiliadasContatoService::delete($id);
        return redirect()->route('afiliadas-contatos.index')->with('success', 'Afiliada Contato deletada com successo.');

    }

    public function pesquisar(Request $request) {
        $dataForm = $request->except('_token');
        $afiliadasContatos = isset($request->nome) ? AfiliadasContatoService::findByName($request->nome, $this->totalPage) : AfiliadasContatoService::getAll('id', 'ASC', $this->totalPage);

        return view('pages.afiliadas-contatos.index', compact('afiliadasContatos'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('dataForm', $dataForm);
    }
}
