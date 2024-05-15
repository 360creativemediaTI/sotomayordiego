<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Player;
use Validator;

class PlayerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();

        return $this->sendResponse($players->toArray(), 'Players retrieved successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'position' => 'required|string',
            'team_id' => 'required|integer',
        ]);

        $player = new Player();
        $player->name = $request->input('name');
        $player->age = $request->input('age');
        $player->name = $request->input('position');
        $player->age = $request->input('team_id');
        $player->save();

        return response()->json(['message' => 'Player created successfully', 'player' => $player], 201);
    }
}
