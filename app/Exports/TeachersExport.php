<?php

namespace App\Exports;

use App;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TeachersExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    private $headings = [
        'Name',
        'Email',
        'Gender',
        'Teacher Code',
        'Blood Group',
        'Phone Number',
        'Address'
    ];
    private $headinsBn = [
        'নাম',
        'ইমেল',
        'লিঙ্গ',
        'শিক্ষকের কোড',
        'রক্তের গ্রুপ',
        'ফোন নম্বর',
        'ঠিকানা'
    ];

    private $headingsES = [
        'Nombre',
        'Correo',
        'Genero',
        'Codigo del Maestro',
        'Grupo Sanguineo',
        'Telefono',
        'Dirección'
    ];

    public function __construct(int $status)
    {
        $this->status = $status;
    }

    public function headings(): array
    {
        $myLocale = App::getLocale();
        if ($myLocale == "es-MX") {
            return $this->headingsES; //spanish
        } elseif ($myLocale == "bn") {
            return $this->headinsBn; //Bangla
        } else {
            return $this->headings;    //english
        }
    }

    public function query()
    {
        return User::query()
            ->select('name', 'email', 'gender', 'student_code', 'blood_group', 'phone_number', 'address')
            ->bySchool(auth()->user()->school_id)
            ->where('role', 'teacher')
            ->where('active', $this->status)
            ->orderBy('name');
    }
}
