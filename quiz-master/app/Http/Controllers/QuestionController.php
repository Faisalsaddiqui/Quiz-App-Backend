<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Option;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index()
    {
        $question = Question::select('id', 'question')->inRandomOrder()->get();

        return $question;
    }

    public function show()
    {
        $question = Question::with(['options'])->get();
        return $question;
    }

    public function store(StoreQuestionRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $question = new Question();
                $question->question = $request->input('question');
                $question->save();

                $data = [];
                foreach ($request->options as $option) {
                    $data[] = [
                        'option' => $option['option'],
                        'is_correct' => $option['is_correct'],
                    ];
                }
                !$question->options()->createMany($data);
            });
        } catch (Exception $e) {
            return "Error occured";
        }

        return "Added successfully";
    }

    public function destroy($question_id)
    {
        if (Question::find($question_id)->delete()) {
            return "Deleted successfully";
        }
        return "Error";
    }
}
