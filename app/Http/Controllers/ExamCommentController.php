<?php

namespace App\Http\Controllers;

use App\ExamComment;
use Illuminate\Http\Request;

class ExamCommentController extends Controller
{

    public function store(Request $request)
    {
        $comment = $request->comment;
        $school_id = auth()->user()->school_id;
        if (empty($comment))
            return 404;
        ExamComment::updateOrCreate(
            ['exam_id' => $request->exam_id, 'student_id' => $request->student_id],
            ['school_id' => $school_id, 'comment' => $comment]
        );
        return 200;
    }


}
