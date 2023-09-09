<?php

namespace App\Exports;

use App;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentsExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    private $headings = [
        'Name',
        'Email',
        'Phone Number',
        'Gender',
        'Student Code',
        'Blood Group',
        'Section',
        'Class',
        'Address'
    ];
    private $headingsBN = [
        'নাম',
        'ইমেল',
        'ফোন নম্বর',
        'লিঙ্গ',
        'শিক্ষার্থী কোড',
        'রক্তের গ্রুপ',
        'সেকশন',
        'ক্লাস',
        'ঠিকানা'
    ];

    private $headingsES = [ //for spanish
        'Nombre',
        'Correo',
        'Tefelono',
        'Genero',
        'Matricula',
        'Grupo sanguineo',
        'Seccion',
        'Clase',
        'Dirección'
    ];

    public function __construct(int $status)
    {
        $this->status = $status;
    }

    public function query()
    {
        return User::query()->select('users.name', 'users.email', 'users.phone_number', 'users.gender', 'users.student_code', 'users.blood_group', 'sections.section_number', 'classes.class_number', 'users.address')
            ->where('users.school_id', auth()->user()->school_id)
            ->where('users.role', 'student')
            ->where('users.active', $this->status)
            ->join('sections', 'sections.id', '=', 'users.section_id')
            ->join('classes', 'sections.class_id', '=', 'classes.id')
            ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
            ->where('student_infos.session', currentSession()->id)
            ->orderBy('users.name');
    }

    public function headings(): array
    {
        $myLocale = App::getLocale();
        if ($myLocale == "es-MX") {
            return $this->headingsES; //spanish
        } elseif ($myLocale == "bn") {
            return $this->headingsBN; //Bangla
        } else {
            return $this->headings;    //english
        }
    }
}
