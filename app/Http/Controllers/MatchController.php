<?php

namespace App\Http\Controllers;

use App\Match;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = Match::all();
        $teams = Team::all();
        $matches_without_results = Match::where('host_team_result', '=', NULL)
            ->where('guest_team_result','=', NULL)->get();
        return view('index')
            ->with(['matches'=> $matches])
            ->with(['teams' => $teams])
            ->with(['matches_without_results' => $matches_without_results]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private  function validate_match_request(Request $request){
        if ($request->host_team == $request->guest_team)
        {
            return '0';
        }else {
            return '1';
        }
    }

    public function store(Request $request)
    {
        $validate = $this->validate_match_request($request);
        if ($validate == '1')
        {
            $match = new Match();
            $match->host_team_id = $request->host_team;
            $match->guest_team_id = $request->guest_team;
            $match->match_date = $request->date;
            $match->save();
            return response()->json(['success' => 'Match saved']);
        } else {
            return response()->json(['error' => 'Mistake']);
        }
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
    public function edit($id)
    {
        //
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
