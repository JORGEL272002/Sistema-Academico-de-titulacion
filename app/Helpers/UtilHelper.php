<?php

namespace App\Helpers;

class UtilHelper
{

    public static function getTypeUsers()
    {
        return [
            'administrador' => 'Administrador',
            'docente' => 'Docente',
            'estudiante' => 'Estudiante',
        ];
    }

    public static function getGradeAcademic()
    {
        return [
            'sin_asignar' => 'Sin Asignar',
            'licenciatura' => 'Licenciatura',
            'doctorado' => 'Doctorado',
            'ingenieria' => 'Ingeniería',
            'maestria' => 'Maestría',
        ];
    }

    public static function getTypePayments()
    {
        return [
            'efectivo' => 'Efectivo',
            'qr' => 'QR',
            'transferencia_bancaria' => 'Transferencia Bancaria',
        ];
    }

    public static function discountReason()
    {
        return [
            'descuento' => 'Descuento',
            'adelanto' => 'Adelanto'
        ];
    }
}
