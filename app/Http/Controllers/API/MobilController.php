<?php

namespace App\Http\Controllers\API;

use App\Models\Mobil;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobils = Mobil::all();

        return response()->json([
            'success' => true,
            'data' => $mobils
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
            'jenis' => 'required|string',
            'tahun_keluaran' => 'required|integer',
            'warna' => 'required|string',
            'harga' => 'required|numeric',
            'mesin' => 'required|string',
            'kapasitas_penumpang' => 'required|integer',
            'tipe' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $mobilData = $request->only(['jenis', 'tahun_keluaran', 'warna', 'harga']);
        $mobil = Mobil::create($mobilData);

        $mobil->mesin = $request->input('mesin');
        $mobil->kapasitas_penumpang = $request->input('kapasitas_penumpang');
        $mobil->tipe = $request->input('tipe');
        $mobil->save();

        return response()->json([
            'success' => true,
            'data' => $mobil,
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
        $mobil = Mobil::find($id);

        if (!$mobil) {
            return response()->json([
                'success' => false,
                'message' => 'Mobil not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mobil,
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
            'jenis' => 'required|string',
            'tahun_keluaran' => 'required|integer',
            'warna' => 'required|string',
            'harga' => 'required|numeric',
            'mesin' => 'required|string',
            'kapasitas_penumpang' => 'required|integer',
            'tipe' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $mobil = Mobil::find($id);

        if (!$mobil) {
            return response()->json([
                'success' => false,
                'message' => 'Mobil not found',
            ], 404);
        }

        $mobilData = $request->only(['jenis', 'tahun_keluaran', 'warna', 'harga']);
        $mobil->fill($mobilData);
        $mobil->mesin = $request->input('mesin');
        $mobil->kapasitas_penumpang = $request->input('kapasitas_penumpang');
        $mobil->tipe = $request->input('tipe');
        $mobil->save();

        return response()->json([
            'success' => true,
            'data' => $mobil,
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
        $mobil = Mobil::find($id);

        if (!$mobil) {
            return response()->json([
                'success' => false,
                'message' => 'Mobil not found',
            ], 404);
        }

        $mobil->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mobil deleted successfully',
        ]);
    }
}
