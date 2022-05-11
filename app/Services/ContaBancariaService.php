<?php

namespace App\Services;

use App\ContaBancaria;
use App\Unidade;
use App\Banco;
use App\Helpers\Helper;

class ContaBancariaService {
    public static function getAll($orderBy, $direction, $pagination = 10) {
        return ContaBancaria::orderBy($orderBy, $direction)->paginate($pagination);
    }

    public static function getAllBancos() {
        return Banco::all();
    }

    public static function findByName($name, $pagination = 10) {
        return ContaBancaria::whereRaw("UPPER(favorecido) LIKE '%". strtoupper($name)."%'")->orderBy('favorecido', 'ASC')->paginate($pagination);
    }

    public static function get($id) {
        return ContaBancaria::find($id);
    }

    public static function getAllUnidades() {
        return Unidade::all();
    }

    public static function save($data) {
        $data['favorecido_cnpj'] = Helper::rmSpecialChars($data['favorecido_cnpj']);
        ContaBancaria::create($data);
    }

    public static function update($data, $id) {
        $contaBancaria = ContaBancaria::find($id);
        if ($contaBancaria) {
            $data['favorecido_cnpj'] = Helper::rmSpecialChars($data['favorecido_cnpj']);
            $contaBancaria->update($data);
        }
    }

    public static function delete($id) {
        ContaBancaria::find($id)->delete();
    }
}
