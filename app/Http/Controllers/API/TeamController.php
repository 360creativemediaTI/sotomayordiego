<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Team;
use App\Player;
use Validator;

class TeamController extends BaseController
{
    public function league($teamId)
    {
        // Encuentra el equipo por su ID
        $team = Team::findOrFail($teamId);

        // Obtiene las ligas asociadas al equipo
        $league = $team->league;

        return response()->json($league);
    }

    public function players($teamId)
    {
        // Encuentra el equipo por su ID
        $team = Team::findOrFail($teamId);

        // Obtiene los jugadores asociados al equipo
        $players = $team->players;

        return response()->json($players);
    }

    public function addPlayer(Request $request, $teamId)
    {
        $request->validate([
            'player_id' => 'required|exists:players,id',
        ]);

        $team = Team::findOrFail($teamId);

        $player = Player::findOrFail($request->input('player_id'));

        $player->team_id = $team->id;
        $player->save();

        return response()->json(['message' => 'Player added to team successfully'], 200);
    }
}
