<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! auth()->user()->can('docente.index')) {
            abort(403, 'Unauthorized action.');
        }
        if (request()->ajax()) {
            $docentes = User::select('carnet', 'nombres', 'apellidos')->where('tipo_usuario', 'docente')->orderBy('id', 'desc');
            return DataTables::of($docentes)
                ->addColumn('full_name', function ($row) {
                    return $row->nombres . ' ' . $row->apellidos;
                })
                ->removeColumn(['id'])
                ->make(true);
        }

        return view('docentes.index');
    }
}
