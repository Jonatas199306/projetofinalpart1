<?php

namespace App\Services;

use App\Afiliadas;
use App\Helpers\Helper;
use App\Unidade;

class AfiliadasService {

    public static function getAll($orderBy, $direction, $pagination = 10, $filter) {

        $afiliadas = Afiliadas::query();
        $appends = [];

        if($filter->nome) {
            $afiliadas = $afiliadas->where('nome', 'like', "%{$filter->nome}%");
            $appends['nome'] = $filter->nome;
        }

        if($filter->cnpj) {
            $cnpj = Helper::rmSpecialChars($filter->cnpj);
            $afiliadas = $afiliadas->where('cnpj', $cnpj);
            $appends['cnpj'] = $cnpj;
        }

        $afiliadas = $afiliadas->orderBy($orderBy, $direction)->paginate($pagination)->appends($appends);
        return $afiliadas;
    }

    public static function get($id) {
        return Afiliadas::find($id);
    }

    public static function getAllUnidades() {
        return Unidade::all();
    }

    public static function save($data) {
        $afiliada = $data;
        $afiliada['cnpj'] = Helper::rmSpecialChars($afiliada['cnpj']);
        $afiliada['telefone'] = Helper::rmSpecialChars($afiliada['telefone']);
        $afiliada['celular'] = Helper::rmSpecialChars($afiliada['celular']);
        $afiliada['cep'] = Helper::rmSpecialChars($afiliada['cep']);
      
        Afiliadas::create($afiliada);
    }

    public static function update($data, $id) {
        $afiliada = $data;
        $afiliada['cnpj'] = Helper::rmSpecialChars($afiliada['cnpj']);
        $afiliada['telefone'] = Helper::rmSpecialChars($afiliada['telefone']);
        $afiliada['celular'] = Helper::rmSpecialChars($afiliada['celular']);
        $afiliada['cep'] = Helper::rmSpecialChars($afiliada['cep']);

        $afiliadaUpdate = Afiliadas::find($id);
        if ($afiliadaUpdate) {
            $afiliadaUpdate->update($afiliada);
        }
    }

    public static function delete($id) {
        Afiliadas::find($id)->delete();
    }
}
