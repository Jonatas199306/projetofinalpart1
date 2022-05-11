<?php

namespace App\Services;

use App\AfiliadasContato;
use App\Helpers\Helper;
use App\Unidade;

class AfiliadasContatoService {
    public static function getAll($orderBy, $direction, $pagination = 10) {
        return AfiliadasContato::orderBy($orderBy, $direction)->paginate($pagination);
    }

    public static function findByName($name, $pagination = 10) {
        return AfiliadasContato::whereRaw("UPPER(nome) LIKE '%". strtoupper($name)."%'")->orderBy('nome', 'ASC')->paginate($pagination);
    }

    public static function get($id) {
        return AfiliadasContato::find($id);
    }

    public static function save($data) {
        $afiliadasContatos = $data;
        $afiliadasContatos['telefone'] = Helper::rmSpecialChars($afiliadasContatos['telefone']);
        $afiliadasContatos['celular'] = Helper::rmSpecialChars($afiliadasContatos['celular']);
        AfiliadasContato::create($afiliadasContatos);
    }

    public static function update($data, $id) {
        $afiliada = AfiliadasContato::find($id);
        $afiliadasContatos = $data;
        $afiliadasContatos['telefone'] = Helper::rmSpecialChars($afiliadasContatos['telefone']);
        $afiliadasContatos['celular'] = Helper::rmSpecialChars($afiliadasContatos['celular']);
        if ($afiliada) {
            $afiliada->update($afiliadasContatos);
        }
    }

    public static function delete($id) {
        AfiliadasContato::find($id)->delete();
    }
}
