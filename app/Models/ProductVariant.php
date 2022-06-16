<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductVariant extends Model
{
    use HasFactory;
    protected $table = 'product_variant';
    public $timestamps = false;
    protected $guarded = [];

    /* product */
    public function variant_product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    /* document */
    public function document()
    {
        /* Funciona, solo hay que validar que no sea null, etc. */
        return $this->hasOne('App\Models\Document');
    }

    public function path($id)
    {
        /* Obtenemos el mismo resultado que es el método document, pero aquí si validamos */
        $document = DB::table('documents')
            ->where('product_variant_id', $id)->first();
        /* Si es null(no existe documento) */
        if (is_null($document)) {
            /* Para el href */
            return "#";
        } else {
            /* Si existe un registro se regresa solo el path del documento */
            return '/storage/' . $document->path;
        }
    }
}
