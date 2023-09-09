<?php

namespace App\Imports;

use App\User;
use App\Myclass;
use App\Section;
use App\Department;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

//use Maatwebsite\Excel\Concerns\WithChunkReading;

class FirstTeacherSheetImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    protected $class, $section, $department;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $this->class = (string)$row[__('class')] ?? 0;
        $this->section = (string)$row[__('section')];
        $this->department = $row[__('department')];
        $school_id = auth()->user()->school_id;
        $student_code = generateStudentCode($school_id, true);
        $email = $row[__('email')] ?? $student_code . '@' . str_replace('www.', '', $_SERVER['SERVER_NAME']);
        return new User([
            'name' => $row[__('name')],
            'email' => $email,
            'password' => Hash::make($row[__('password')] ?? '123'),
            'active' => 1,
            'role' => 'teacher',
            'school_id' => $school_id,
            'code' => auth()->user()->code,
            'student_code' => $student_code,
            'address' => $row[__('address')],
            'about' => $row[__('about')] ?? '',
            'pic_path' => '',
            'phone_number' => $row[__('phone_number')] ?? uniqid(),
            'verified' => 1,
            'section_id' => $this->getSectionId(),// For assigning as class teacher
            'blood_group' => $row[__('blood_group')] ?? '',
            'nationality' => $row[__('nationality')] ?? '',
            'gender' => $row[__('gender')],
            'department_id' => $this->getDepartmentId(),
        ]);
    }

    public function getSectionId()
    {
        if (!empty($this->class) && !empty($this->section)) {
            $class_id = Myclass::bySchool(auth()->user()->school_id)->where('class_number', $this->class)->pluck('id')->first();

            return Section::where('class_id', $class_id)->where('section_number', $this->section)->pluck('id')->first();
        } else {
            return 0;
        }
    }

    public function getDepartmentId()
    {
        return Department::bySchool(auth()->user()->school_id)->where('department_name', $this->department)->pluck('id')->first();
    }

    public function batchSize(): int
    {
        return 200;
    }
}
