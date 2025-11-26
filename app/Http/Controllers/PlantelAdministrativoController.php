<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            $planteAdministrativo = User::select('carnet', 'nombres', 'apellidos', 'created_at')->where('tipo_usuario', 'administrador')->orderBy('id', 'desc');
            return DataTables::of($planteAdministrativo)
                ->addColumn('full_name', function ($row) {
                    return $row->nombres . ' ' . $row->apellidos;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->removeColumn(['id'])
                ->make(true);
        }

        return view('plantel_administrativo.index');
    }

    public function getPlantelAdministrativoData(Request $request)
    {
        $term = $request->input('term');
        $page = $request->input('page', 1);

        $users = User::where('status', 1)->where('tipo_usuario', 'administrador')
            ->where(function ($query) use ($term) {
                $query->where('nombres', 'LIKE', '%' . $term . '%')
                    ->orWhere('apellidos', 'LIKE', '%' . $term . '%')
                    ->orWhere('carnet', 'LIKE', '%' . $term . '%');
            })
            ->orderBy('apellidos', 'asc');

        return $users->paginate(5, ['*'], 'page', $page);
    }
}
