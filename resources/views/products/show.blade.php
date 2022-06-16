@extends('layouts.app')

@section('title')
    Producto
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
                        <select class="form-control form-control-sm" id="product_variant_id" name="product_variant_id">
                            <option value="" selected>Por favor, elige</option>
                            @foreach ($product->variants as $item)
                                <option value="{{ $item->id }}">{{ $item->product_variant_name }}</option>
                            @endforeach
                        </select>
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
            <h3 class="page__heading">Producto</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="section-title">Datos del producto:</h2>
                            {{-- {{ $product->type->code }} --}}
                            <h6 class="mt-4">Denominación distintiva: <small
                                    class="text-muted">{{ $product->deno_distintiva }}</small>
                            </h6>
                            <h6 class="mt-4">Denominación genérica: <small
                                    class="text-muted">{{ $product->deno_generica }}</small>
                            </h6>
                            <h6 class="mt-4">Registro sanitario: <small
                                    class="text-muted">{{ $product->reg_sanitario }}</small>
                            </h6>
                            <h6 class="mt-4">Clase: <small
                                    class="text-muted">{{ $product->type_id }}</small>
                            </h6>
                            <h6 class="mt-4">Descripción: <small
                                    class="text-muted">{{ $product->descripcion }}</small>
                            </h6>
                            <h6 class="mt-4">Fecha de actualización: <small
                                    class="text-muted">{{ $product->updated_at }}</small>
                            </h6>
                            {{-- <hr class="solid"> --}}
                            <h2 class="section-title">Presentaciones</h2>
                            <div class="text-right p-2">
                                {{-- Permisos --}}
                                {{-- @can('crear-variante')
                                    <button class="btn btn-space btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                                            class="fas fa-plus"></i> Agregar clave</button>
                                @endcan --}}
                                {{-- Control permiso --}}
                                <input type="hidden" id="ctrl-permission" name="ctrl-permission"
                                    value="{{ auth()->user()->can('borrar-variante') }}">
                                {{-- Permisos --}}
                                {{-- @can('crear-variante')
                                    <button class="btn btn-space btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                                            class="fas fa-plus"></i> Agregar variante</button>
                                @endcan --}}
                            </div>
                            <br>
                            {{-- product_id para obtener el ID del producto para usarlo en el js --}}
                            <input type="hidden" value="{{ $product->id }}" name="product_id" id="product_id">
                            {{-- Tabla --}}
                            <table id="variants" class="table table-striped mt-2" style="width: 100%">
                                <thead style="background-color: #6777ef;">
                                    <tr>
                                        <th scope="col" class="text-white text-center">#</th>
                                        <th scope="col" class="text-white text-center">Sub producto</th>
                                        <th scope="col" class="text-white text-center">Archivo modificado</th>
                                        <th scope="col" class="text-white text-center">Descripción</th>
                                        <th scope="col" class="text-white text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

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
