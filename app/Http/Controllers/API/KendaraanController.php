<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraans = Kendaraan::all();

        return response()->json([
            'success' => true,
            'data' => $kendaraans
        ]);
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
            'tahun_keluaran' => 'required|integer',
            'warna' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $kendaraan = Kendaraan::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $kendaraan,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Kendaraan not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kendaraan,
        ]);
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
        $validator = Validator::make($request->all(), [
            'tahun_keluaran' => 'required|integer',
            'warna' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Kendaraan not found',
            ], 404);
        }

        $kendaraan->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $kendaraan,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Kendaraan not found',
            ], 404);
        }
    
        $kendaraan->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Kendaraan deleted successfully',
        ]);
    }
}
