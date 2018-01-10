<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Beat;
use App\Score;
use Validator;

class BeatsController extends Controller
{
    public function getBeats()
    {
        //$user_id = Auth::user()->id;
        //$beats = Beat::where('user_id', $user_id)->get();
        $beats = Beat::all();

        return response()->json($beats, 200);

    }

    public function storeBeat(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'steps' => 'required',
            'bpm' => 'required',
            'repeats' => 'required'
        ]);

        $name = $request->input('name');
        $steps = $request->input('steps');
        $bpm = $request->input('bpm');
        $repeats = $request->input('repeats');
        $layout = $request->input('layout');
        $jsonlayout = json_encode($layout);

        $beat = Beat::create([
            'name' => $name,
            'steps' => $steps,
            'bpm' => $bpm,
            'repeats' => $repeats,
            'layout' => $jsonlayout
            ]
        );

        $beat->save();

        return response()->json("Ok", 200);
    }

    public function getBeat($id)
    {
        $beat = Beat::FindOrFail($id);

        return response()->json($beat);
    }

    public function updateBeat(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'steps' => 'required',
            'bpm' => 'required',
            'repeats' => 'required',
            'layout' => 'required'
        ]);

        $name = $request->input('name');
        $steps = $request->input('steps');
        $bpm = $request->input('bpm');
        $repeats = $request->input('repeats');
        $layout = $request->input('layout');


        $beat = Beat::findOrFail($id);

        $beat->name = $name;
        $beat->steps = $steps;
        $beat->bpm = $bpm;
        $beat->repeats = $repeats;
        $beat->layout = $layout;

        $beat->save();

        return response()->json("Ok", 200);
    }

    public function deleteBeat($id)
    {
        $beat = Beat::findOfFail($id);
        $beat->delete();

        return response()->json("Ok", 200);
    }

    public function getScores($beat_id) {
        $scores = Score::where('beat_id', $beat_id)->get();

        $scores->map(function($score) {
            $user = User::findOrFail($score->user_id);
            $score->name = $user->name;
            return $score;
        });

        return response()->json($scores, 200);
    }

    public function getScore($user_id, $beat_id) {
        $score = Score::where(['user_id' => $user_id, 'beat_id' => $beat_id])->first();
        $user = User::findOrFail($score->user_id);
        $score->name = $user->name;

        return response()->json($score, 200);
    }

    public function storeScore(Request $request) {
        $this->validate($request, [
            'beat_id' => 'required',
            'user_id' => 'required',
            'score' => 'required'
        ]);

        $beat_id = $request->input('beat_id');
        $user_id = $request->input('user_id');
        $score = $request->input('score');

        $score = Score::create([
            'beat_id' => $beat_id,
            'user_id' => $user_id,
            'score' => $score
        ]);

        $score->save();

        return response()->json("Ok", 200);
    }

    public function updateScore(Request $request, $user_id, $beat_id) {

        $this->validate($request, [
           'score' => 'required'
        ]);

        $score = Score::where(['user_id' => $user_id, 'beat_id' => $beat_id])->first();

        $score->score = $request->input('score');

        $score->save();

        return response()->json("Ok", 200);
    }
}
