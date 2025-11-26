<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\UtilHelper;
use Yajra\DataTables\Facades\DataTables;

class UsuarioController extends Controller
{

    protected $util;

    public function __construct(Util $util)
    {
        return $this->util = $util;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! auth()->user()->can('usuario.index')) {
            abort(403, 'Unauthorized action.');
        }
        if (request()->ajax()) {
            $users = User::select(['id', 'nombres', 'apellidos', 'carnet', 'email', 'status'])->orderBy('id', 'desc');

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $user_auth = Auth::user()->id;
                    $editUrl = route('usuarios.edit', $user->id);
                    $deleteUrl = route('usuarios.destroy', $user->id);

                    $canEdit = auth()->user()->can('usuario.update');
                    $canDelete = auth()->user()->can('usuario.delete') && $user->id !== $user_auth;
                    $editDisabled = $canEdit ? '' : 'disabled';
                    $deleteDisabled = $canDelete ? '' : 'disabled';

                    $buttons = '
                    <button data-href="' . $editUrl . '" class="btn btn-icon btn-sm btn-round btn-primary edit_user"
                    ' . $editDisabled . ' title="Editar">
                        <i class="icon-pencil"></i>
                    </button>
                    &nbsp;';

                    $buttons .= '
                    <button data-href="' . $deleteUrl . '" class="btn btn-icon btn-sm btn-round btn-danger delete_user"
                    ' . $deleteDisabled . ' title="Eliminar">
                        <i class="icon-trash"></i>
                    </button>';

                    return $buttons;
                })
                ->addColumn('full_name', function ($row) {
                    return $row->nombres . ' ' . $row->apellidos;
                })

                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Sí' : 'No';
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('usuarios.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->can('usuario.create')) {
            abort(403, 'Unauthorized action.');
        }
        $roles = $this->util->getRoleData();
        $typeUsers = UtilHelper::getTypeUsers();
        return view('usuarios.create', compact('roles', 'typeUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('usuario.create')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            $input = $request->only(['nombres', 'apellidos', 'carnet', 'direccion', 'celular', 'email', 'fecha_nacimiento', 'tipo_usuario']);
            $input['password'] = Hash::make($input['carnet']);
            $role = Role::findOrFail($request->input('role'));
            $user  = User::create($input);
            $user->assignRole($role->name);

            $output = [
                'success' => true,
                'data'    => $user,
                'msg'     => __('messages.add_success'),
            ];
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[0] == '23000') {
                $mensaje = $e->errorInfo[2];

                if (str_contains($mensaje, 'carnet')) {
                    $msg = 'El carnet ingresado ya está registrado.';
                } elseif (str_contains($mensaje, 'email')) {
                    $msg = 'El email ingresado ya está registrado.';
                } else {
                    $msg = __('messages.something_went_wrong');
                }

                $output = [
                    'success' => false,
                    'msg'     => $msg,
                ];
            } else {
                Log::emergency(__('messages.error_log'), [
                    'Archivo' => $e->getFile(),
                    'Línea'   => $e->getLine(),
                    'Mensaje' => $e->getMessage(),
                ]);
                $output = [
                    'success' => false,
                    'msg'     => __('messages.something_went_wrong'),
                ];
            }
        } catch (\Exception $e) {
            Log::emergency(__('messages.error_log'), [
                'Archivo' => $e->getFile(),
                'Línea'   => $e->getLine(),
                'Mensaje' => $e->getMessage(),
            ]);
            $output = [
                'success' => false,
                'msg'     => __('messages.something_went_wrong'),
            ];
        }

        // Devuelve siempre JSON con cabecera correcta
        return response()->json($output);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (! auth()->user()->can('usuario.view')) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (! auth()->user()->can('usuario.update')) {
            abort(403, 'Unauthorized action.');
        }
        if (request()->ajax()) {
            $user = User::find($id);
            $roles = $this->util->getRoleData();
            $typeUsers = UtilHelper::getTypeUsers();
            return view('usuarios/edit', compact('user', 'roles', 'typeUsers'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (! auth()->user()->can('usuario.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $input = $request->only(['nombres', 'apellidos', 'carnet', 'direccion', 'celular', 'email', 'fecha_nacimiento', 'tipo_usuario']);

                $user = User::findOrFail($id);
                $user->nombres = $input['nombres'];
                $user->apellidos = $input['apellidos'];
                $user->carnet = $input['carnet'];
                $user->direccion = $input['direccion'];
                $user->celular = $input['celular'];
                $user->email = $input['email'];
                $user->fecha_nacimiento = $input['fecha_nacimiento'];
                $user->tipo_usuario = $input['tipo_usuario'];
                $user->password = Hash::make($input['carnet']);
                DB::beginTransaction();
                $user->update();
                $role_id = $request->input('role');
                $user_role = $user->roles->first();
                $previous_role = !empty($user_role->id) ? $user_role->id : 0;
                if ($previous_role != $role_id) {
                    $is_admin = $this->util->is_admin($user);
                    $all_admins = $this->util->getAdmins();
                    if ($is_admin && count($all_admins) <= 1) {
                        return   $output = [
                            'success' => false,
                            'msg' => __('messages.cannot_change'),
                        ];
                    }
                    if (!empty($previous_role)) {
                        $user->removeRole($user_role->name);
                    }

                    $role = Role::findOrFail($role_id);
                    $user->assignRole($role->name);
                }
                $output = [
                    'success' => true,
                    'msg' => __('messages.updated_success'),
                ];
                DB::commit();
            } catch (\Exception $e) {
                Log::emergency(__('messages.error_log'), [
                    'Archivo' => $e->getFile(),
                    'Línea'   => $e->getLine(),
                    'Mensaje' => $e->getMessage(),
                ]);

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (! auth()->user()->can('usuario.delete')) {
            abort(403, 'Unauthorized action.');
        }
        if (request()->ajax()) {
            try {
                $user = User::findOrFail($id);
                $user->delete();

                $output = [
                    'success' => true,
                    'msg' => __('messages.deleted_success'),
                ];
            } catch (\Exception $e) {
                Log::emergency(__('messages.error_log'), [
                    'Archivo' => $e->getFile(),
                    'Línea'   => $e->getLine(),
                    'Mensaje' => $e->getMessage(),
                ]);

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }

    public function getUserData(Request $request)
    {
        $term = $request->input('term');
        $page = $request->input('page', 1);

        $users = User::where('status', 1)
            ->where(function ($query) use ($term) {
                $query->where('nombres', 'LIKE', '%' . $term . '%')
                    ->orWhere('apellidos', 'LIKE', '%' . $term . '%')
                    ->orWhere('carnet', 'LIKE', '%' . $term . '%');
            })
            ->orderBy('apellidos', 'asc');

        return $users->paginate(5, ['*'], 'page', $page);
    }
}
