<?php

namespace App\Http\Controllers;

use App\RetornoCodigoOperacao;
use App\RetornoCodigoResultado;
use Illuminate\Http\Request;

class RetornosController extends Controller
{
    public function index()
    {
        return view('pages.retornos.index');
    }

    public function importar(Request $request) {

        $file = $request->file('arq_retorno');
        $content = file_get_contents($file->path());
        $lines = explode("\n", $content);

        $result = $this->processFile($lines);

        return response()->json($result);
    }

    function processFile($lines) {

        $result = [];

        foreach ($lines as $index => $line) {

            if(
                (int)substr($line, (1-1), 1) === 0 ||
                (int)substr($line, (1-1), 1) === 9
            ) continue; // pular registro de cabecalho

            $beneficio = substr($line, (2 - 1), 10);
            $codigoOperacao = RetornoCodigoOperacao::find((int)substr($line, (12 - 1), 1))->descricao;
            $codigoResultado = RetornoCodigoResultado::find((int)substr($line, (13 - 1), 1))->descricao;
            $codigoErro = substr($line, (14 - 1), 3);
            $valorDesconto = $this->getValorDesconto(substr($line, (17 - 1), 5));
            $dtInicioDesconto = $this->formatDateLayoutDataprev(substr($line, (22 - 1), 6));
            $codigoEspecieBeneficio = substr($line, (29 - 1), 2);

            $result[] = [
                'beneficio' => $beneficio,
                'codigo_operacao' => $codigoOperacao,
                'codigo_resultado' => $codigoResultado,
                'codigo_erro' => $codigoErro,
                'valor_desconto' => $valorDesconto,
                'dt_inicio_desconto' => $dtInicioDesconto,
                'codigo_especie_beneficio' => $codigoEspecieBeneficio
            ];
        }

        return $result;
    }

    function getValorDesconto($valor) {
        $int = (int)substr($valor, 0, 3);
        $dec = (int)substr($valor, 3, 2);
        $valorDesconto = $int . '.' . $dec;

        return (double)$valorDesconto;
    }

    function formatDateLayoutDataprev($date) {
        $year = substr($date, 0, 4);
        $month = substr($date, 4, 2);

        return $year . '-' . $month;
    }
}
