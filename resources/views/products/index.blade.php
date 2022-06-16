@extends('layouts.app')

@section('title')
    Productos
@endsection

@section('css')
    <link href="{{ asset('web/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Productos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-producto')
                                <div class="text-right pb-3">
                                    <a class="btn btn-primary" href="{{ route('products.create') }}"><i
                                            class="fas fa-plus"></i>Nuevo</a>
                                </div>
                            @endcan
                            {{-- VALIDAR POR TIPO DE USUARIO Y MOSTRA ACCIONES DIFERENTES, CRAERA TABLA Y RUTA PARA CADA UNO
                            @can('update', $post)
                                <table id="products" class="display table table-striped" style="width:100%">
                            @endcan --}}
                            <div class="table-responsive">
                                <span>

                                </span>
                                <table id="example" class="table table-hover table-sm" style="width:100%">
                                    <thead style="background-color: #6777ef;">
                                        <tr>
                                            <th scope="col" style=" display: none"># id</th>
                                            <th scope="col" class="text-white">Denominación Distintiva</th>
                                            <th scope="col" class="text-white">Denominación Genérica</th>
                                            <th scope="col" class="text-white">No. de Registro Sanitario</th>
                                            <th scope="col" class="text-white">Clase</th>
                                            <th scope="col" class="text-white">Descripción</th>
                                            <th scope="col" class="text-center text-white w-10">Actualizado en</th>
                                            <th scope="col" class="text-center text-white w-10">Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr>
                                                <td scope="row" style="display: none">{{ $item->id }}</td>
                                                <td>{{ $item->deno_distintiva }}</td>
                                                <td>{{ $item->deno_generica }}</td>
                                                <td>{{ $item->reg_sanitario }}</td>
                                                <td>{{ $item->type_id }}</td>
                                                <td>{{ $item->descripcion }}</td>
                                                <td class="text-center">{{ $item->updated_at }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Third group">
                                                        <a class="btn btn-info"
                                                            href="{{ route('products.show', $item->id) }}"><i
                                                                class="fa fa-arrow-circle-right"></i></a>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Third group">
                                                        @can('editar-producto')
                                                            <a class="btn btn-info"
                                                                href="{{ route('products.edit', $item->id) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endcan
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Third group">
                                                        @can('borrar-producto')
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $item->id]]) !!}
                                                            {{ Form::button('<i class="fa fa-trash-alt" aria-hidden="true"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                                                            {!! Form::close() !!}
                                                        @endcan
                                                    </div>
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
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('web/js/tables-custom.js') }}"></script>
@endsection
