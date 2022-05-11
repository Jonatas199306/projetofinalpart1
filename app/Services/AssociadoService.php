<?php

namespace App\Services;

use App\Afiliadas;
use App\Associado;
use App\BeneficioEspecie;
use App\Helpers\Helper;
use App\Unidade;

class AssociadoService {

    public static function getAll($orderBy, $direction, $pagination = 10, $filter) {

        $associado = Associado::query();
        $appends = [];

        if($filter->nome) {

            $associado = $associado->where('nome', 'like', "%{$filter->nome}%");
            $appends['nome'] = $filter->nome;
        }
        
        
        if($filter->cpf) {
            
            $cpf = Helper::rmSpecialChars($filter->cpf);
            $associado = $associado->where('cpf', $cpf);
            $appends['cpf'] = $cpf;
        }
        
        if($filter->beneficio) {
            
            $beneficio = Helper::rmSpecialChars($filter->beneficio);
            $associado = $associado->where('beneficio', 'like', "%{$beneficio}%");
            $appends['beneficio'] = $beneficio;
        }


        $associado = $associado
            ->orderBy($orderBy, $direction)
            ->paginate($pagination)
            ->appends($appends);

        return $associado;
    }

    public static function findByName($name, $pagination = 10) {
        return Associado::whereRaw("UPPER(nome) LIKE '%". strtoupper($name)."%'")->orderBy('nome', 'ASC')->paginate($pagination);
    }

    public static function get($id) {
        return Associado::find($id);
    }

    public static function save($data) {
        $associado = $data;
        $associado['cpf'] = Helper::rmSpecialChars($associado['cpf']);
        Associado::create($associado);
    }

    public static function update($data, $id) {
        $associado = $data;
        $associado['cpf'] = Helper::rmSpecialChars($associado['cpf']);

        $associadoUpdate = Associado::find($id);
        if ($associadoUpdate) {
            $associadoUpdate->update($associado);
        }
    }

    public static function delete($id) {
        Associado::find($id)->delete();
    }

    public static function getAllAfiliadas() {
        return Afiliadas::all();
    }

    public static function getAllEspecies() {
        return BeneficioEspecie::all();
    }
}
