<?php

namespace App;


class TeacherEducationInfo extends Model
{
    protected $table = 'teacher_education_infos';
    protected $fillable = ['user_id', 'level_of_education', 'exam_degree_title', 'others', 'result', 'group', 'institution', 'duration', 'year_of_passing', 'status'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
