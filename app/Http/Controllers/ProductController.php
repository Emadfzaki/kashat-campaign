<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductTranslation;
use App\MultiMedia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        $response = [
            'msg' => 'Products get successfully',
            'products' => $products,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'vendor_id' => 'required|integer',
            'created_by' => 'required|integer',
            'updated_by' => 'required|integer',

            'title' => 'required|string',
            'locale' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $product = new Product();
        $product['category_id'] = $request['category_id'];
        $product['vendor_id'] = $request['vendor_id'];
        $product['created_by'] = $request['created_by'];
        $product['updated_by'] = $request['updated_by'];
        $product['extra'] = $request['extra_product'];
        if($product->save()){
            $product_translation = new ProductTranslation();
            $product_translation['product_id'] = $product['id'];
            $product_translation['title'] = $request['title'];
            $product_translation['locale'] = $request['locale'];
            $product_translation['extra'] = $request['extra_product_tr'];

            if($request['files']){
                foreach ($request['files'] as $key => $file) {

                    $file_path = $file->store('products_files');
                    $file_type = Storage::mimeType($file_path);

                    $multimedia = new MultiMedia();
                    $multimedia['content_type'] = 'product';
                    $multimedia['content_id'] = $product['id'];

                    $multimedia['file_location'] = $file_path;
                    $multimedia['file_type'] = $file_type;
                    $multimedia['title'] = $request['file_title'][$key];

                    $multimedia->save();
                }
            }

            if($product_translation->save()){
                $response = [
                    'msg' => 'Product created successfully',
                ];

                return response()->json($response, 201);
            }
        }

        $response = [
            'msg' => 'Products can not created'
        ];

        return response()->json($response, 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);

        if($product){
            $product['multimedia'] = $product->multimedia();
            $product['translation'] = $product->translations();
            $response = [
                'msg' => 'Product found',
                'product' => $product
            ];
            return response()->json($response, 200);
        }
        $response = [
            'msg' => 'Product not found',
        ];
        return response()->json($response, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_trans_id)
    {
        $validator = Validator::make($request->all(), [
            'updated_by' => 'required|integer',
            'title' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $product_trans = ProductTranslation::find($product_trans_id);
        if($product_trans){
            $product_trans['title'] = $request['title'];
            if($product_trans->save()){
                if(Product::where('id', $product_trans['id'])->update(['updated_by' => $request['updated_by']])){
                    $response = [
                        'msg' => 'Product updated successfully'
                    ];
                    return response()->json($response, 200);
                }

            }

            $response = [
                'msg' => 'Product not updated',
            ];
            return response()->json($response, 400);
        }
        $response = [
            'msg' => 'Product not found',
        ];
        return response()->json($response, 404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $product = Product::find($product_id);
        if($product){
            if ($product->delete()){
                ProductTranslation::where('product_id', $product_id)->delete();
                MultiMedia::where('content_id', $product_id)->where('content_type', 'product')->delete();
                $response = [
                    'msg' => 'Product deleted successfully',
                ];
                return response()->json($response, 200);
            }
        }

        $response = [
            'msg' => 'Product not found',
        ];
        return response()->json($response, 404);
    }
}
