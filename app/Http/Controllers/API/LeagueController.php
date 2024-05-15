<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\League;
use Validator;


class LeagueController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = Leagues::all();

        return $this->sendResponse($leagues->toArray(), 'Leagues retrieved successfully.');
    }

    /**
     * 
     * 
     * @return 
     */
    public function teams($leagueId)
    {
        $league = League::findOrFail($leagueId);

        $teams = $league->teams;

        return response()->json($teams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $league = League::create($input);


        return $this->sendResponse($league->toArray(), 'League created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $league = League::find($id);


        if (is_null($league)) {
            return $this->sendError('League not found.');
        }


        return $this->sendResponse($league->toArray(), 'League retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, League $league)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $league->name = $input['name'];
        $league->save();


        return $this->sendResponse($league->toArray(), 'League updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(League $league)
    {
        $league->delete();


        return $this->sendResponse($league->toArray(), 'League deleted successfully.');
    }
}