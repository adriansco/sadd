<?php

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('variants/{id}/', function ($id) {
    /* variants */
    $query = DB::table('product_variant')
        ->select('product_variant.id', 'product_variant.product_id', 'product_variant.product_variant_name', 'product_variant.info')
        ->where('product_variant.product_id', $id)
        ->get();
    return DataTables::of($query)
        ->addColumn('btn', 'variants/actions')
        ->rawColumns(['btn'])
        ->toJson();
});

Route::get('documents/{id}/', function ($id) {
    /* variants */
    $query = DB::table('documents')
        ->select('id', 'name', 'lot', 'path', 'product_variant_id', 'updated_at')
        ->where('product_variant_id', $id)
        ->get();
    for ($i = 0; $i < count($query); $i++) {
        $updated_at = Carbon::parse($query[$i]->updated_at);
        $query[$i]->updated_at = $updated_at->diffForHumans();;
    }
    return DataTables::of($query)
        ->addColumn('btn', 'documents/actions')
        ->rawColumns(['btn'])
        ->toJson();
});

/* ->editColumn('created_at', function ($doc) {
            return $doc->created_at->diffForHumans();
        }) */
        
/* return datatables()->query(DB::table('documents'))
        ->addColumn('btn', 'documents/actions')
        ->rawColumns(['btn'])
        ->toJson(); */

/* Route::get('variants', function () {
    return datatables()->query(DB::table('variants')->where('status', 'A'))
        ->addColumn('btn', 'variants/actions')
        ->rawColumns(['btn'])
        ->toJson();
}); */
