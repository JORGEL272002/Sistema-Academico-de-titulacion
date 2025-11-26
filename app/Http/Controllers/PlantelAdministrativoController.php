<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class PlantelAdministrativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! auth()->user()->can('plantel_administrativo.index')) {
            abort(403, 'Unauthorized action.');
        }
        if (request()->ajax()) {
            $planteAdministrativo = User::select('carnet', 'nombres', 'apellidos')->where('tipo_usuario', 'administrador')->orderBy('id', 'desc');
            return DataTables::of($planteAdministrativo)
                ->addColumn('full_name', function ($row) {
                    return $row->nombres . ' ' . $row->apellidos;
                })
                ->removeColumn(['id'])
                ->make(true);
        }

        return view('plantel_administrativo.index');
    }
}
