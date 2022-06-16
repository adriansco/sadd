<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\File;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|borrar-producto', ['only' => ['index']]);
        $this->middleware('permission:crear-producto', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-producto', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-producto', ['only' => ['destroy']]);
    }

    public function index()
    {
        /* $products = Product::where('status', 'A')->paginate(5);
        return view('products.index', compact('products')); */
        return view('products.index');
    }
    public function fetchById($id)
    {
        $products = Product::where('type_id', $id)->get();
        foreach ($products as $product) {
            /* Convertir a romano XD */
            $product->type_id = $this->a_romano($product->type_id) . PHP_EOL;
        }
        return view('products.index', compact('products'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'deno_distintiva' => 'string|required|min:2|max:191',
            'deno_generica' => 'string|required|min:1|max:191',
            'reg_sanitario' => 'string|required|min:1|max:191',
            'type_id' => 'required|min:1|max:1',
            'descripcion' => 'string|required|min:1|max:255',
        ]);
        $product = Product::create($request->all());
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $types = Type::all();
        return view('products.create', compact('types'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            /* 'file' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip|max:2048',
            'name' => 'string|required|min:2|max:75',
            'payroll' => 'required|min:2|max:191',
            'status' => 'required|min:1|max:1', */
            'name' => 'string|required|min:2|max:75',
            'deno_distintiva' => 'string|required|min:2|max:191',
            'deno_generica' => 'string|required|min:1|max:191',
            'reg_sanitario' => 'string|required|min:1|max:191',
            'type_id' => 'required|min:1|max:1',
            'descripcion' => 'string|required|min:1|max:255',
        ]);
        $product->update($request->all());

        return view('products.show', compact('product'));
        /* try {
            DB::beginTransaction();
            if ($request->hasFile('file')) {
                $fileDB = new File();
                $file = $request->file('file');
                $file->move(public_path() . '/' . $product->payroll . '/', $file->getClientOriginalName());
                $fileDB->name = 'test';
                $fileDB->path = $file->getClientOriginalName();
                $fileDB->product_payroll = $product->payroll;
                $fileDB->save();
                $product->update($request->except('file'));
            } else {
                $product->update($request->all());
            }
            DB::commit();
            return redirect()->route('products.index');
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        } */
    }
    public function destroy(Product $product)
    {
        $id = $product->type_id;
        $product->delete();
        $products = Product::where('type_id', $id)->get();
        return view('products.index', compact('products'));
    }
    public function edit(Product $product)
    {
        $types = Type::all();
        return view('products.edit', compact('product', 'types'));
    }

    public function show(Product $product)
    {
        $product->type_id = $this->a_romano($product->type_id) . PHP_EOL;
        return view('products.show', compact('product'));
    }

    public function a_romano($integer, $upcase = true)
    {
        $table = array(
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100,
            'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9,
            'V' => 5, 'IV' => 4, 'I' => 1
        );
        $return = '';
        while ($integer > 0) {
            foreach ($table as $rom => $arb) {
                if ($integer >= $arb) {
                    $integer -= $arb;
                    $return .= $rom;
                    break;
                }
            }
        }
        return $return;
    }
}
