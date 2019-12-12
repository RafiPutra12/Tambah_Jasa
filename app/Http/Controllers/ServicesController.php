<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services;

class ServicesController extends Controller
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

    public function tambah(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'userid' => 'required|integer',
			'name' => 'required|string|max:255',
			'descriptions' => 'required|string|max:255',
			'minimumprice' => 'required|integer',
		]);

		if($validator->fails()){
			return response()->json([
				'status'	=> 0,
				'message'	=> $validator->errors()->toJson()
			]);
		}

        $services = new Services();
        $services->userid 	    = $request->userid;
		$services->name 	    = $request->name;
		$services->descriptions = $request->descriptions;
        $services->minimumprice = $request->minimumprice;       
		$services->save();

		return response()->json([
			'status'	=> '1',
			'message'	=> 'Jasa berhasil terregistrasi'
		], 201);
    }

    public function getAll($limit = 10, $offset = 0){
        $data["count"] = Services::count();
        $services = array();
        
        foreach (Services::take($limit)->skip($offset)->get() as $p) {
            $item = [
                "id"           => $p->id,
                "userid"       => $p->userid,
                "name"         => $p->name,
                "descriptions" => $p->descriptions,
                "minimumprice" => $p->minimumprice,
                "status"       => $p->status,
                "created_at"   => $p->created_at,
                "updated_at"   => $p->updated_at,
            ];
            

            array_push($services, $item);
        }
        $data["services"] = $services;
        $data["status"] = 1;
        return response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $services = Services::where('id', $id)->first();

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}