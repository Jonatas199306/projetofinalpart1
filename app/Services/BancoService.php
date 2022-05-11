<?php

namespace App\Services;

use App\Banco;

class BancoService {
    public static function getAll($orderBy, $direction, $pagination = 10) {
        return Banco::orderBy($orderBy, $direction)->paginate($pagination);
    }

    public static function findByName($name, $pagination = 10) {
        return Banco::whereRaw("UPPER(nome) LIKE '%". strtoupper($name)."%'")->orderBy('nome', 'ASC')->paginate($pagination);
    }

    public static function get($id) {
        return Banco::find($id);
    }

    public static function save($data) {
        Banco::create($data);
    }

    public static function update($data, $id) {
        $banco = Banco::find($id);
        if ($banco) {
            $banco->update($data);
        }
    }

    public static function delete($id) {
        Banco::find($id)->delete();
    }
}
