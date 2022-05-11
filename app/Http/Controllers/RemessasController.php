<?php

namespace App\Http\Controllers;

use App\Afiliadas;
use App\Associado;
use App\Parametro;
use App\Remessa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Catch_;

class RemessasController extends Controller
{
    public function index()
    {

        /**
         * AE - AGUARDANDO ENVIO
         * AP - ALTERAÇÃO DE PERCENTUAL
         * EN = ENVIADO
         * 
         */

        $afiliadas = DB::select("
            SELECT
                afiliadas.id,  
                unidades.sigla as unidade_sigla, 
                afiliadas.nome,
                (   select count(*) from associados 
                    where associados.afiliadas_id = afiliadas.id
                ) as qtde_associados,
                (   select count(*) from associados 
                    where associados.afiliadas_id = afiliadas.id
                    and associados.status_envio IN ('AE', 'AP')
                ) as qtde_novos_associados
            FROM 
                unidades 
                INNER JOIN afiliadas ON afiliadas.unidades_id = unidades.id
        ");


        return view('pages.remessas.index', compact('afiliadas'));
    }

    public function getNewAssociados($afiliada)
    {
        return Associado::where('afiliadas_id', $afiliada)
            ->whereIn('status_envio', ['AE', 'AP'])
            ->get();
    }

    public function gerarRemessa(Request $request)
    {

        $competencia = Carbon::parse($request->competencia)->format('Ym'); // Ano e mês da Remessa yyyymm
        $arquivo = "D.SUB.GER.116.{$competencia}";

        
        $associados = Associado::whereIn('status_envio', ['AE', 'AP'])->where('ativo', 'S')->get();


        $file = fopen("remessas/{$arquivo}", "w");

        $cabecalho = Parametro::first()->cabecalho_remessa;
        fwrite($file, "{$cabecalho}\n");


        if (Remessa::where('competencia', $competencia)->count()) {

            return response()->json([
                'message' => 'Ooops... Esta remessa já foi criada previamente!'
            ], 403);

        } else {

            try {

                DB::begintransaction();

                if(!$associados->count()) {
                    
                    return response()->json([
                        'message' => "Não existe movimentação nesta remessa!"
                    ], 403);
                }

                foreach ($associados as $associado) {

                    $beneficio = $associado->beneficio; // nº de benefício do associado                
                    $codOperacao = $associado->solicitacao_exclusao ? 5 : 1; // código da operação que é solicitada pelo cliente // 1: inclusão 5: exclusão
                    $desconto = $associado->desconto;

                    if($desconto > Parametro::first()->limite_desconto) {

                        return response()->json([
                            'message' => "O desconto percentual do(a) associado(a) {$associado->nome} está acima do limite estabelecido"
                        ], 403);
                    }
                    
                    $ativo = 'S';
                    $usersId = Auth::user()->id;

                    $remessa = Remessa::create([
                        'competencia'     => $competencia,
                        'ass_beneficio'   => $beneficio,
                        'codigo_operacao' => $codOperacao,
                        'desconto'        => $desconto,
                        'arquivo'         => $arquivo,
                        'ativo'           => $ativo,
                        'users_id'        => $usersId
                    ]);

                    fwrite($file, "1"); // padrão
                    fwrite($file, $beneficio); // número de benefício do associado
                    fwrite($file, $codOperacao); // código de operação
                    fwrite($file, "000"); // padrão
                    fwrite($file, "{$this->formatDesconto($desconto)}\n"); // formatar desconto
                }

                // escrever o trailer do arquivo
                fwrite($file, $this->formatFooter($associados->count())); 
                fclose($file);
                
                DB::commit();
                // env('APP_URL')
                $fileUrl = "/remessas";

                return response()->json([
                    'message'  => 'Remessa gerada com sucesso!',
                    'fileName' => $arquivo,
                    'fileUrl'  => "$fileUrl/$arquivo"   
                ], 200);

            } catch (\Exception $e) {

                DB::rollback();
                // fclose($file);
                dd($e);
                return response()->json(['message' => 'Oooops... Algo deu errado!', 500]);
            }
        }

    }

    public function formatDesconto($desconto)
    {
        $desconto = (String)$desconto;
        
        if(strlen($desconto) === 1) {

            return str_pad($desconto, 5, "0", STR_PAD_BOTH);
        }   

        $arrDesconto = explode('.', $desconto);
        $arrDesconto[0] = str_pad($arrDesconto[0], 3, "0", STR_PAD_LEFT);
        $arrDesconto[1] = str_pad($arrDesconto[1], 2, "0", STR_PAD_RIGHT);

        return implode('', $arrDesconto);
    }

    public function formatFooter($qtdeAssociados)
    {
        $strFooter = "9"; // padrão
        $qtdeAssociados = $qtdeAssociados + 2;
        $qtdeAssociados = (String)$qtdeAssociados;
        $qtdeAssociados = str_pad($qtdeAssociados, 6, "0", STR_PAD_LEFT);

        return "{$strFooter}{$qtdeAssociados}";
    }
}
