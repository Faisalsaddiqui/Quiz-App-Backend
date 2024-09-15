<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index($question_id)
    {
        $option = Option::select(['id', 'option'])->where('question_id', $question_id)->get();
        return $option;
    }


    //Checks if the given option is correct or not
    public function verify($question_id, $option_id)
    {
        $option = Option::all()
            ->where('question_id', $question_id)
            ->where('id', $option_id)
            ->where('is_correct');
        if (count($option)) {
            return 1;
        } else {
            return 0;
        }
    }
}
