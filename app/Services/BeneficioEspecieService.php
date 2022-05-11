<?php

namespace App\Services;

use App\BeneficioEspecie;

class BeneficioEspecieService
{

    public static function save($data)
    {
        BeneficioEspecie::create($data);
    }

    public static function get($id)
    {
        return BeneficioEspecie::find($id);
    }

    public static function getAll($orderBy, $direction, $pagination = 10, $filter)
    {
        $beneficioEspecie = BeneficioEspecie::query();

        if($filter->nome) $beneficioEspecie = $beneficioEspecie->where('nome', 'like', "%$filter->nome%");
        
        $beneficioEspecie = $beneficioEspecie->orderBy($orderBy, $direction)->paginate($pagination);

        if($filter->nome) $beneficioEspecie = $beneficioEspecie->appends('nome', $filter->nome);

        return $beneficioEspecie;
    }

    public static function findByName($name, $pagination = 10)
    {
        return BeneficioEspecie::where('nome', 'like', '%' . $name . '%')->orderBy('nome', 'ASC')->paginate($pagination);
    }
}
