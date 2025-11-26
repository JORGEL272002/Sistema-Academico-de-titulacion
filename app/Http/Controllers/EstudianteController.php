<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            $estudiantes = User::select('carnet', 'nombres', 'apellidos', 'created_at')->where('tipo_usuario', 'estudiante')->orderBy('id', 'desc');
            return DataTables::of($estudiantes)
                ->addColumn('full_name', function ($row) {
                    return $row->nombres . ' ' . $row->apellidos;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->removeColumn(['id'])
                ->make(true);
        }

        return view('estudiantes.index');
    }

    public function getEstudiantesData(Request $request)
    {
        $term = $request->input('term');
        $page = $request->input('page', 1);

        $users = User::where('status', 1)->where('tipo_usuario', 'estudiante')
            ->where(function ($query) use ($term) {
                $query->where('nombres', 'LIKE', '%' . $term . '%')
                    ->orWhere('apellidos', 'LIKE', '%' . $term . '%')
                    ->orWhere('carnet', 'LIKE', '%' . $term . '%');
            })
            ->orderBy('apellidos', 'asc');

        return $users->paginate(5, ['*'], 'page', $page);
    }
}
