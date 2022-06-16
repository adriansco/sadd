<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VariantController extends Controller
{
    public function fetchVariant($id)
    {
        $product = Product::find($id);
        $variants = $product->variants;
        return response()->json([
            'variants' => $variants,
        ]);
    }

    /* Eliminar registro y documento */
    public function destroy($id)
    {
        /* Buscar variante */
        $variant = ProductVariant::find($id);
        /* Solo debe existir un documento para esa variable */
        /* $document = DB::table('documents')
            ->where('product_variant_id', $id)->first(); */
        /* Validar si existe el registro */
        if ($variant) {
            /* Borrar variante, se elimina en cascada => $document->delete(); */
            $variant->delete();
            /* Eliminar documento del servidor (documento local) */
            /* Storage::disk('public')->delete($document->path); */
            /* Storage::disk('public')->delete('/storage/'.$file->path); */
            return response()->json([
                'response' => [
                    'status' => 201,
                    'msg' => 'Su archivo ha sido eliminado.',
                ]
            ], 201);
        } else {
            return response()->json([
                'response' => [
                    'status' => 400,
                    'msg' => 'No existe el registro',
                ]
            ], 201);
        }
    }
}
