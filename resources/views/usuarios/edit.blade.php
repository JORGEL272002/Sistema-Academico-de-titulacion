<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header no-bd bg-primary">
            <h3 class="modal-title">
                <span class="fw-mediumbold">
                    Editar
                </span>
                <span class="fw-light">
                    Usuario
                </span>
            </h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="small">
                Llena todos los campos con (*) para actualizar el registro.
            </p>

            <form action="{{ route('usuarios.update', $user->id) }}" method="POST" id="edit_user">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label>C.I</label>
                            <input name="carnet" type="text" class="form-control input-number"
                                placeholder="Ingrese cédula de identidad" value="{{ $user->carnet }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label>Nombres</label>
                            <input name="nombres" type="text" class="form-control" placeholder="Ingrese nombres"
                                value="{{ $user->nombres }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label>Apellidos</label>
                            <input name="apellidos" type="text" class="form-control" placeholder="Ingrese apellidos"
                                value="{{ $user->apellidos }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label>Correo</label>
                            <input name="email" type="email" class="form-control" placeholder="Ingrese correo"
                                value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label for="role">Permiso</label>
                            <select class="form-control" name="role" class="form-control">
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $key }}"
                                        {{ $key === $user->roles->first()->id ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label for="tipo_usuario">Tipo de Usuario</label>
                            <select class="form-control" name="tipo_usuario" id="tipo_usuario" style="width: 100%">
                                @foreach ($typeUsers as $key => $typeUser)
                                    <option value="{{ $key }}"
                                        {{ $key === $user->tipo_usuario ? 'selected' : '' }}>
                                        {{ $typeUser }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Telefono</label>
                            <input name="celular" type="text" class="form-control input-number"
                                placeholder="Ingrese celular" value="{{ $user->celular }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Fecha de nacimiento</label>
                            <input name="fecha_nacimiento" type="date" class="form-control"
                                value="{{ $user->fecha_nacimiento }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Dirección</label>
                            <input name="direccion" type="text" class="form-control" placeholder="Ingrese dirección"
                                value="{{ $user->direccion }}">
                        </div>
                    </div>
                </div>

                <div class="modal-footer no-bd mt-3">
                    <button type="submit" class="btn btn-primary">
                        Actualizar
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
