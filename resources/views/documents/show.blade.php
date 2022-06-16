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
                        <label for="title">Op</label>
                        <input type="text" class="form-control" required="" id="title" name="title">
                        <div class="invalid-feedback">Oh no! El campo op no es válido.</div>
                        <div class="valid-feedback">¡Ok!</div>
                    </div>
                    <div class="form-group">
                        <label for="lot">Lote</label>
                        <input type="text" class="form-control" required="" id="lot" name="lot">
                        {{-- <div class="text-primary">*Por el momento el campo lote está deshabilitado.</div> --}}
                        <div class="invalid-feedback">Oh no! El campo lote no es válido.</div>
                        <div class="valid-feedback">¡Ok!</div>
                    </div>
                    {{-- end control --}}
                    <div class="form-group">
                        {{-- Variante --}}
                        <input type="hidden" id="product_variant_id" name="product_variant_id" value="{{ $key->id }}">
                    </div>
                    <div class="form-group">
                        <label for="inputfile">Archivo</label>
                        <input type="file" class="form-control" id="inputfile" name="file">
                        <div class="invalid-feedback" id="div-error">Oh no! El archivo no es válido.</div>
                        <div class="valid-feedback">¡Ok!</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="button btn btn-primary" id="btn-register">Guardar</button>
                </div>
            </div>
        </div>
    </form>
    {{-- Content --}}
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Documentosss</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="section-title">Certificados {{ $key->product_variant_name }}</h2>
                            <div class="text-right p-2">
                                {{-- Permisos --}}
                                @can('crear-documento')
                                    <button class="btn btn-space btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                                            class="fas fa-plus"></i> Agregar documento</button>
                                @endcan
                                {{-- Control permiso --}}
                                <input type="hidden" id="ctrl-permission" name="ctrl-permission"
                                    value="{{ auth()->user()->can('borrar-documento') }}">
                            </div>
                            <br>
                            {{-- Tabla --}}
                            {{-- product_id para obtener el ID del producto para usarlo en el js --}}
                            <input type="hidden" value="{{ $key->id }}" name="product_id" id="product_id">
                            <table id="documents" class="table table-striped mt-2" style="width: 100%">
                                <thead style="background-color: #6777ef;">
                                    <tr>
                                        <th scope="col" class="text-white text-center dont-show">#</th>
                                        <th scope="col" class="text-white text-center dont-show">Sub test</th>
                                        <th scope="col" class="text-white text-center dont-show">Archivo modificado</th>
                                        <th scope="col" class="text-white text-center">Nombre</th>
                                        <th scope="col" class="text-white text-center">Lote</th>
                                        <th scope="col" class="text-white text-center">Última modificación</th>
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
    {{-- <script src="{{ asset('web/js/tables-custom.js') }}"></script> --}}
    <script src="{{ asset('web/js/documents-list.js') }}"></script>
@endsection
