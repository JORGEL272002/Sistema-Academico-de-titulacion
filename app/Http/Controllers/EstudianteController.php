<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! auth()->user()->can('estudiante.index')) {
            abort(403, 'Unauthorized action.');
        }
        if (request()->ajax()) {
            $estudiantes = User::select('carnet', 'nombres', 'apellidos')->where('tipo_usuario', 'estudiante')->orderBy('id', 'desc');
            return DataTables::of($estudiantes)
                ->addColumn('full_name', function ($row) {
                    return $row->nombres . ' ' . $row->apellidos;
                })
                ->removeColumn(['id'])
                ->make(true);
        }

        return view('estudiantes.index');
    }
}
