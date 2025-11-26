<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header no-bd bg-primary">
            <h3 class="modal-title">
                <span class="fw-mediumbold">
                    Nuevo
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
                Llena todos los campos para crear un nuevo registro.
            </p>

            <form action="{{ route('usuarios.store') }}" method="POST" id="add_user">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label>C.I</label>
                            <input name="carnet" type="text" class="form-control input-number"
                                placeholder="Ingrese cédula de identidad">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label>Nombres</label>
                            <input name="nombres" type="text" class="form-control" placeholder="Ingrese nombres">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label>Apellidos</label>
                            <input name="apellidos" type="text" class="form-control" placeholder="Ingrese apellidos">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label>Correo</label>
                            <input name="email" type="email" class="form-control" placeholder="Ingrese correo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label for="role">Permiso</label>
                            <select class="form-control" name="role" id="role" style="width: 100%">
                                <option value="" disabled selected>Seleccione</option>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $key }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-group-default required">
                            <label for="tipo_usuario">Tipo de Usuario</label>
                            <select class="form-control" name="tipo_usuario" id="tipo_usuario" style="width: 100%">
                                <option value="" disabled selected>Seleccione</option>
                                @foreach ($typeUsers as $key => $typeUser)
                                    <option value="{{ $key }}">{{ $typeUser }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Celular</label>
                            <input name="celular" type="text" class="form-control input-number"
                                placeholder="Ingrese celular">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Fecha de nacimiento</label>
                            <input name="fecha_nacimiento" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label>Dirección</label>
                            <input name="direccion" type="text" class="form-control" placeholder="Ingrese dirección">
                        </div>
                    </div>
                </div>

                <div class="modal-footer no-bd mt-3">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
