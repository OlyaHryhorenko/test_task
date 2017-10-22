<?php

namespace App\Http\Controllers;

use App\Match;
use App\Team;
use App\Standing;
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
    public function update(Request $request)
    {
        $match = Match::where('id', $request->match_id)->first();
        $match->host_team_result = $request->host_goals;
        $match->guest_team_result = $request->guest_goals;


//        //update host team standings
        $host_team_standings = Standing::where('team_id', $match->host_team_id)->first();
        $host_team_standings->gp += 1;
//
//        //update guest team standings
        $guest_team_standings = Standing::where('team_id', $match->guest_team_id)->first();
        $guest_team_standings->gp += 1;

//        //update win results
        if ($request->host_goals > $request->guest_goals) {
            $host_team_standings->w += 1;
            $host_team_standings->pts += 3;
            $guest_team_standings->l += 1;
            $guest_team_standings->pts += 1;
        } else if ($request->host_goals < $request->guest_goals)
        {

            $host_team_standings->l += 1;
            $host_team_standings->pts += 1;
            $guest_team_standings->w += 1;
            $guest_team_standings->pts += 3;
        } else if ($request->host_goals == $request->guest_goals)
        {
            $host_team_standings->d += 1;
            $guest_team_standings->d += 1;
        }
        $host_team_standings->save();
        $guest_team_standings->save();
        $match->save();

        return response()->json(['success'=> "Results updated"]);
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
