<div class="text-center">
    <a href="{{ route('documents.fetch', ['id' => $id]) }}" class="btn btn-info ml-1"><i class="fa fa-file"></i></a>
    {{-- <a class="btn btn-info ml-1" href="{{ route('variants.update', ['variant' => $id]) }}"><i
            class="fa fa-edit"></i></a> --}}
    {{-- Eliminar (Falta validar permisos mediante js) --}}
    <button id="test" class="btn btn-danger ml-1 destroybtn" type="button" value="{{ $id }}"><i
            class="fa fa-trash"></i></button>
</div>
