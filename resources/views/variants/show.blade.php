@extends('layouts.app')

@section('title')
    Documentos
@endsection

@section('css')
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Modal -->
    <form enctype="multipart/form-data" class="modal fade" id="exampleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- init control --}}
                    <div class="form-group">
                        <label for="title">Nombre del documento</label>
                        <input type="text" class="form-control" required="" id="title" name="title">
                        <div class="invalid-feedback">Oh no! El nombre no es válido.</div>
                        <div class="valid-feedback">¡Bien hecho!</div>
                    </div>
                    {{-- end control --}}
                    <div class="form-group">
                        <label for="product_variant_id">Variante</label>
                        {{-- <select class="form-control form-control-sm" id="product_variant_id" name="product_variant_id">
                            <option value="" selected>Por favor, elige</option>
                            @foreach ($query as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select> --}}
                        <div class="invalid-feedback">Oh no! La variante no es válida.</div>
                        <div class="valid-feedback">¡Bien hecho!</div>
                    </div>
                    <div class="form-group">
                        <label for="inputfile">Archivo</label>
                        <input type="file" class="form-control" id="inputfile" name="file">
                        <div class="invalid-feedback" id="div-error">Oh no! El archivo no es válido.</div>
                        <div class="valid-feedback">¡Bien hecho!</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-register">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    {{-- Content --}}
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Documentos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="section-title">Certificados</h2>
                            <div class="text-right p-2">
                                {{-- Permisos --}}
                                @can('crear-documento')
                                    <button class="btn btn-space btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                                            class="fas fa-plus"></i> Agregar documento</button>
                                @endcan
                                {{-- Control permiso --}}
                                <input type="hidden" id="ctrl-permission" name="ctrl-permission"
                                    value="{{ auth()->user()->can('borrar-variante') }}">
                            </div>
                            <br>
                            {{-- Tabla --}}
                            <table id="variants" class="table table-striped mt-2" style="width: 100%">
                                <thead style="background-color: #6777ef;">
                                    <tr>
                                        <th scope="col" class="text-white text-center">#</th>
                                        <th scope="col" class="text-white text-center">Sub test</th>
                                        <th scope="col" class="text-white text-center">Archivo modificado</th>
                                        <th scope="col" class="text-white text-center">Descripción</th>
                                        <th scope="col" class="text-white text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $item)
                                        <tr>
                                            <td style="display: none;">{{ $item->id }}</td>
                                            <td style="">{{ $item->name }}</td>
                                            <td style="">{{ $item->created_at }}</td>
                                            <td style="">{{ $item->updated_at }}</td>
                                            <td class="text-center">
                                                @can('editar-documento')
                                                    <a class="btn btn-info" href="{{ route('roles.edit', $item->id) }}"><i
                                                            class="fa fa-edit"></i> Editar</a>
                                                @endcan
                                                @can('borrar-documento')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['document.destroy', $item->id], 'style' => 'display:inline']) !!}
                                                    {{ Form::button('<i class="fa fa-trash-alt" aria-hidden="true"></i> Eliminar', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                                                @endcan
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('web/js/tables-custom.js') }}"></script>
    <script src="{{ asset('web/js/variants-list.js') }}"></script>
@endsection
