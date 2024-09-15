<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function show($user_id)
    {

        $user = User::find($user_id);
        $scores = $user->scores->map(function ($score) {
            return [
                'score' => $score->score,
                'created_at' => $score->created_at->diffForHumans()
            ];
        });
        return $scores;
    }

    public function store(Request $request)
    {
        $request->validate([
            'score' => 'required|min:0|max:' . Question::all()->count()
        ]);

        Score::create([
            'user_id' =>  auth()->id(),
            'score' => $request->score
        ]);

        return 'Successfully inserted';
    }
}
