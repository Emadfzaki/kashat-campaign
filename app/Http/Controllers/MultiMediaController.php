<?php

namespace App\Http\Controllers;

use App\MultiMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;

class MultiMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'content_id' => 'required|integer',
            'content_type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if ($request['content_type'] == 'product'){
            if($request['files']){
                foreach ($request['files'] as $key => $file) {

                    $file_path = $file->store('products_files');
                    $file_type = Storage::mimeType($file_path);

                    $multimedia = new MultiMedia();
                    $multimedia['content_type'] = 'product';
                    $multimedia['content_id'] = $request['content_id'];

                    $multimedia['file_location'] = $file_path;
                    $multimedia['file_type'] = $file_type;
                    $multimedia['title'] = $request['file_title'][$key];

                    $multimedia->save();
                }

                $response = [
                    'msg' => 'Files saved successfully',
                ];

                return response()->json($response, 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MultiMedia  $multiMedia
     * @return \Illuminate\Http\Response
     */
    public function show(MultiMedia $multiMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MultiMedia  $multiMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(MultiMedia $multiMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MultiMedia  $multiMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MultiMedia $multiMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MultiMedia  $multiMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy($multimedia_id)
    {
        $multimedia = MultiMedia::find($multimedia_id);
        if($multimedia){
            if ($multimedia->delete()){
                $response = [
                    'msg' => 'File deleted successfully',
                ];
                return response()->json($response, 200);
            }
        }

        $response = [
            'msg' => 'File not found',
        ];
        return response()->json($response, 404);
    }
}
