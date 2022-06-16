<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            /* 'path' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip|max:2048', */
            'title' => 'string|required|min:2|max:75',
            /* 'lot' => 'string|required|min:2|max:25', */
        ]);
        /* variante y documento */
        $id = $request->input('product_variant_id');
        /* Errores del form */
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            $file = $request->file('file');
            try {
                if ($file) {
                    $filename = $file->getClientOriginalName();
                    $foo = \File::extension($filename);
                    if ($foo == 'pdf') {
                        /* date('Ymdhmi') sustituir con el nombre del documento */
                        $route_file = $id . DIRECTORY_SEPARATOR . date('Ymdhmi') . '.' . $foo;
                        Storage::disk('public')->put($route_file, \File::get($file));
                        Document::create([
                            'name' => $request->input('title'),
                            'lot' => $request->input('lot'),
                            'path' => $route_file,
                            'product_variant_id' => $id
                        ]);
                        DB::commit();
                        return response()->json([
                            'response' => [
                                'status' => 201,
                                'msg' => 'Su archivo ha sido guardado',
                            ]
                        ], 201);
                    } else {
                        DB::rollBack();
                        return response()->json([
                            'response' => [
                                'status' => 400,
                                'msg' => 'Solo Archivos PDF',
                            ]
                        ], 201);
                    }
                }
            } catch (Exception $e) {
                DB::rollBack();
                return $e;
            }
        }
    }
    /* Eliminar registro y documento */
    public function destroy($id)
    {
        /* Buscar documento */
        $document = Document::find($id);
        if ($document) {
            /* Borrar documento */
            $document->delete();
            /* Eliminar documento del servidor (documento local) */
            Storage::disk('public')->delete($document->path);
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

    public function fetchDocuments($id)
    {
        $key = DB::table('product_variant')
            ->select('id', 'product_variant_name')
            ->where('id', $id)
            ->first();
        return view('documents.show', compact('key'));
    }

    public function update()
    {
        return 'Holi';
    }
}
