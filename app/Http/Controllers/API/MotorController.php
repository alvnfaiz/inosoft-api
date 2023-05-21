<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motors = Motor::all();

        return response()->json([
            'success' => true,
            'data' => $motors
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
            'tipe_suspensi' => 'required|string',
            'tipe_transmisi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $motorData = $request->only(['jenis', 'tahun_keluaran', 'warna', 'harga']);
        $motor = Motor::create($motorData);

        $motor->mesin = $request->input('mesin');
        $motor->tipe_suspensi = $request->input('tipe_suspensi');
        $motor->tipe_transmisi = $request->input('tipe_transmisi');
        $motor->save();

        return response()->json([
            'success' => true,
            'data' => $motor,
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
        $motor = Motor::find($id);

        if (!$motor) {
            return response()->json([
                'success' => false,
                'message' => 'Motor not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $motor,
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
            'tipe_suspensi' => 'required|string',
            'tipe_transmisi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $motor = Motor::find($id);

        if (!$motor) {
            return response()->json([
                'success' => false,
                'message' => 'Motor not found',
            ], 404);
        }

        $motorData = $request->only(['jenis', 'tahun_keluaran', 'warna', 'harga']);
        $motor->fill($motorData);
        $motor->mesin = $request->input('mesin');
        $motor->tipe_suspensi = $request->input('tipe_suspensi');
        $motor->tipe_transmisi = $request->input('tipe_transmisi');
        $motor->save();

        return response()->json([
            'success' => true,
            'data' => $motor,
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
        $motor = Motor::find($id);

        if (!$motor) {
            return response()->json([
                'success' => false,
                'message' => 'Motor not found',
            ], 404);
        }

        $motor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Motor deleted successfully',
        ]);
    }
}
