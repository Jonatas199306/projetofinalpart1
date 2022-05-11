<?php

namespace App\Services;

use App\Unidade;
use \App\Helpers\Helper;

class UnidadesService {

    public static function getAll($orderBy, $direction, $pagination = 10, $filter) {

        $unidade = Unidade::query();

        if($filter->nome) 
            $unidade = $unidade->where('nome', 'like', "%$filter->nome%");
        
        if($filter->cnpj)
            $unidade = $unidade->where('cnpj', Helper::rmSpecialChars($filter->cnpj));
        

        $unidade = $unidade->orderBy($orderBy, $direction)->paginate($pagination);

        return $unidade;
    }

    public static function findByName($name, $pagination = 10) {
        return Unidade::where('nome', 'like', '%' . $name . '%')->orderBy('nome', 'ASC')->paginate($pagination);
    }

    public static function get($id) {
        return Unidade::find($id);
    }

    public static function save($data) {
        $unidade = $data;

        $unidade['cnpj'] = Helper::rmSpecialChars($unidade['cnpj']);
        $unidade['telefone'] = Helper::rmSpecialChars($unidade['telefone']);
        $unidade['celular'] = Helper::rmSpecialChars($unidade['celular']);
        $unidade['cep'] = Helper::rmSpecialChars($unidade['cep']);

        Unidade::create($unidade);
    }
}
