@extends('layouts.app')

@section('title')
    Crear producto
@endsection

@section('css')
    <link href="{{ asset('web/css/custom.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear producto</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="deno_distintiva">Denominación Distintiva</label>
                                            <input type="text" name="deno_distintiva"
                                                class="form-control @error('deno_distintiva') is-invalid @enderror"
                                                value="{{ old('deno_distintiva') }}">
                                            @error('deno_distintiva')
                                                <div class="invalid-feedback text-bold">*{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="deno_generica">Denominación Genérica</label>
                                            <input type="text" name="deno_generica"
                                                class="form-control @error('deno_generica') is-invalid @enderror"
                                                value="{{ old('deno_generica') }}">
                                            @error('deno_generica')
                                                <div class="invalid-feedback text-bold">*{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="reg_sanitario">No. de Registro Sanitario</label>
                                            <input type="text" name="reg_sanitario"
                                                class="form-control @error('reg_sanitario') is-invalid @enderror"
                                                value="{{ old('reg_sanitario') }}">
                                            @error('reg_sanitario')
                                                <div class="invalid-feedback text-bold">*{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label for="type_id">Clase</label>
                                        <select class="form-control select2 @error('type_id') is-invalid @enderror"
                                            id="type_id" name="type_id">
                                            <option></option>
                                            @foreach ($types as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('type_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                        @error('type_id')
                                            <div class="invalid-feedback text-bold">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea style="height: auto" rows="5" cols="50" name="descripcion"
                                                class="form-control @error('descripcion') is-invalid @enderror"
                                                maxlength="191">{{ old('descripcion') }}</textarea>
                                            @error('descripcion')
                                                <div class="invalid-feedback text-bold">*{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-right p-2">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i>
                                            Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
