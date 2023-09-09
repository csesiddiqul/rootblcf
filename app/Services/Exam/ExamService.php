<?php
namespace App\Services\Exam;

use App\CourseConfig;
use App\Exam;
use App\Course;
use App\Myclass;
use App\ExamForClass;

class ExamService {
    public $examIds;
    public $request;
    public $exam;

    public function getLatestExamsBySchoolIdWithPagination(){
        return Exam::where('school_id', auth()->user()->school_id)
                ->where('session_id',currentSession()->id)
                ->latest()
                ->get();
    }

    public function getActiveExamsBySchoolId(){
        return Exam::where('school_id', auth()->user()->school_id)
                    ->where('active',1)
                    ->where('session_id',currentSession()->id)
                    ->get();
    }

    public function getCoursesByExamIds(){
        return CourseConfig::with('class','teacher')
                    ->whereIn('exam_id', $this->examIds)
                    ->orderBy('class_id')
                    ->get();
    }

    public function getClassesBySchoolId(){
        return Myclass::where('school_id',auth()->user()->school->id)->get();
    }

    public function getAlreadyAssignedClasses(){
        $classes = $this->getClassesBySchoolId()
                        ->pluck('id')
                        ->toArray();
        return ExamForClass::join('exams','exams.id','exam_for_classes.exam_id')->where('exams.session_id', currentSession()->id)
                            ->where('exam_for_classes.active', 1)
                            ->whereIn('exam_for_classes.class_id', $classes)
                            ->select('exam_for_classes.*','exams.exam_name')
                            ->get();
    }

    public function createExam(){
        $session = currentSession();
        $exam = new Exam;
        $exam->exam_name = $this->request->exam_name;
        $exam->active = 1;
        $exam->term = $this->request->term;
        $exam->start_date = date('Y-m-d',strtotime($this->request->start_date));
        $exam->end_date = date('Y-m-d',strtotime($this->request->end_date));
        $exam->notice_published = 0;
        $exam->result_published = 0;
        $exam->session_id = $session->id;
        $exam->school_id = auth()->user()->school_id;
        $exam->user_id = auth()->user()->id;
        $exam->save();
        return $exam;
    }

    public function updateCoursesWithExamId(){
        Course::whereIn('class_id',$this->request->classes)->update([
            'exam_id' => $this->exam->id
        ]);
    }

    public function assignClassesToExam(){
        $tc = count($this->request->classes);
        $i = 0;
        while($i < $tc){
            $examForClass = new ExamForClass;
            $examForClass->exam_id = $this->exam->id;
            $examForClass->class_id = $this->request->classes[$i];
            $efc[] = $examForClass->attributesToArray();
            ++$i;
        }
        return $efc;
    }

    public function storeExam(){
        \DB::transaction(function () {
            $this->exam = $this->createExam();
            // Assign Exam ID to Classes in Course Table
           // $this->updateCoursesWithExamId();

           $efc = $this->assignClassesToExam();

            if(count($efc) > 0)
                ExamForClass::insert($efc);
        }, 5);
    }

    public function updateExamFields(){
        $tb = Exam::bySchool(auth()->user()->school_id)->find($this->request->exam_id);
        $tb->notice_published = isset($this->request->notice_published)?1:0;
        $tb->result_published = isset($this->request->result_published)?1:0;
        $tb->active = (isset($this->request->active))?1:0;
        $tb->save();
        if (isset($this->request->active)) {
            Exam::bySchool(auth()->user()->school_id)->where('id', '!=', $this->request->exam_id)->update(array('active' => 0));
        }
    }

    public function updateExamForClass(){
        if(!isset($this->request->active)){
            ExamForClass::where('exam_id', $this->request->exam_id)->update(['active'=>0]);
        }
    }

    public function updateExam(){
        \DB::transaction(function () {
            $this->updateExamFields();
            $this->updateExamForClass();
        });
    }
}