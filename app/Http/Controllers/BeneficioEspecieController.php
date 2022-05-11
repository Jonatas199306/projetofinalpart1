<?php

namespace App\Http\Controllers;
use App\Services\BeneficioEspecieService;
use Illuminate\Http\Request;
use App\BeneficioEspecie;

class BeneficioEspecieController extends Controller
{
    private $totalPage = 10;

    public function index(Request $request) {
        return view('pages.especie.index')->with('especies', BeneficioEspecieService::getAll('id', 'ASC', $this->totalPage, $request));
    }

    public function cadastrar() {
        return view('pages.especie.cadastrar');
    }

    public function salvar(Request $request) {
        $request->validate([
            'nome' => 'required|string'
        ]);

        BeneficioEspecieService::save($request->all());
        return redirect()->route('especie.index')->with('success','Beneficio espécie cadastrada com successo.');
    }

    public function editar($id) {
        $especie = BeneficioEspecieService::get($id);
        return view('pages.especie.editar',compact('especie'));
    }

    public function atualizar(Request $request, $id) {
        $request->validate([
            'nome' => 'required|string'
        ]);
        $input = $request->all();
        $input = array_except($input, ['_token']);
        BeneficioEspecie::where('id', $id)->update($input);
        return redirect()->route('especie.index')->with('success','Beneficio espécie atualizado com successo.');
    }

    public function deletar($id) {
        BeneficioEspecie::find($id)->delete();
        return redirect()->route('especie.index')->with('success','Beneficio espécie deletado com successo.');
        }
}
