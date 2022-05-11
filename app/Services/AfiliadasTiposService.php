<?php

namespace App\Services;

use App\AfiliadasTipo;
use App\Unidade;

class AfiliadasTiposService {
    public static function getAll($orderBy, $direction, $pagination = 10) {
        return AfiliadasTipo::orderBy($orderBy, $direction)->paginate($pagination);
    }

    public static function findByName($name, $pagination = 10) {
        return AfiliadasTipo::whereRaw("UPPER(descricao) LIKE '%". strtoupper($name)."%'")->orderBy('descricao', 'ASC')->paginate($pagination);
    }

    public static function get($id) {
        return AfiliadasTipo::find($id);
    }

    public static function save($data) {
        AfiliadasTipo::create($data);
    }

    public static function update($data, $id) {
        $afiliada = AfiliadasTipo::find($id);
        if ($afiliada) {
            $afiliada->update($data);
        }
    }

    public static function delete($id) {
        AfiliadasTipo::find($id)->delete();
    }
}
