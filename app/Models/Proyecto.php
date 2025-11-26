<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $guarded = ['id'];

    public function docenteGuia()
    {
        return $this->belongsTo(User::class, 'id_docente_guia');
    }

    public function docenteRevisor()
    {
        return $this->belongsTo(User::class, 'id_docente_revisor');
    }

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'id_estudiante');
    }
}
