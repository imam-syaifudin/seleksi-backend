<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $player = Player::get();
        if ( $player->isEmpty() ){
            return response()->json([
                'error' => 'Player Not Found'
            ],404);
        }

        return response()->json([
            'data' => $player
        ],200);

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
        //
        $validate = $request->validate([
            'posisi' => 'required',
            'nama' => 'required|string',
            'nomor_punggung' => 'required|integer',
        ],
        [
            'nomor_punggung.integer' => 'Invalid number'
        ]
    );

        try {
            
            $player = Player::create([
                'posisi' => $request->posisi,
                'nama' => $request->nama,
                'nomor_punggung' => $request->nomor_punggung,
                'createdBy' => auth()->user()->id
            ]);
            return response()->json([
                $player
            ],200);

        } catch (Exception $error){
            return response()->json([
                'error' => 'Invalid number'
            ],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       

        try {

            $player = Player::findOrFail($id);
            return response()->json($player,200);
            
            
        } catch(Exception $error ){ 
            return response()->json([
                'error' => 'Player Not Found'
            ],404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validate = $request->validate([
            'posisi' => 'required',
            'nama' => 'required|string',
            'nomor_punggung' => 'required|integer',
        ],
        [
            'nomor_punggung.integer' => 'Invalid number'
        ]
    );

        try {
            $player = Player::findOrFail($id);
            $player->update([
                'posisi' => $request->posisi,
                'nama' => $request->nama,
                'nomor_punggung' => $request->nomor_punggung,
                'modifiedBy' => auth()->user()->id
            ]);
            return response()->json([
                $player
            ],200);

        } catch (Exception $error){
            return response()->json([
                'error' => 'Invalid number'
            ],422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {

            $player = Player::findOrFail($id);
            $player->delete();
            return response()->json(
                ['success'  => 'Data deleted succesfuly']
            ,200);


        } catch(Exception $eror){
            return response()->json(
                ['error'  => 'No Player Found']
            ,404);
        }
    }
}
