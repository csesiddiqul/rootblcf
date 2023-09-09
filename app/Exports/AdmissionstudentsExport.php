<?php

namespace App\Exports;

use App;
use App\User;
use App\Admission;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdmissionstudentsExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    private $headings = [
        'Admission Year',
        'Roll',
        'Password',
        'Student Name',
        'Mobile',
        'Father name',
        'Mother name',
        'Father Mobile',
        'Place of Birth',
        'Date of Birth',
        'Class',
        'Gender',
        'Religion',
        'Birth Certificate No./IC No./Passport No',
        'Nationality'
    ];

    private $headingsBn = [
        'ভর্তির বছর',
        'রোল',
        'পাসওয়ার্ড',
        'শিক্ষার্থীর নাম',
        'মোবাইল নম্বর',
        'বাবার নাম',
        'মায়ের নাম',
        'বাবার মোবাইল নম্বর',
        'জন্মস্থান',
        'জন্ম তারিখ',
        'ক্লাস',
        'লিঙ্গ',
        'ধর্ম',
        'জন্ম শংসাপত্র নং / আইসি নং / পাসপোর্ট নং',
        'জাতীয়তা',

    ];

    private $headingsES = [
        'Año de admisión',
        'Rollo',
        'Password',
        'Nombre del estudiante',
        'Número de teléfono móvil',
        'Nombre del Padre',
        'Nombre de la madre',
        'Número de móvil del padre',
        'Lugar de nacimiento',
        'Fecha de cumpleaños',
        'Clase',
        'Genero',
        'Religión',
        'No de acta de nacimiento / No de CI / No de pasaporte',
        'Nacionalidad'
    ];

    public function __construct(int $admissionstatus)
    {
        $this->status = $admissionstatus;
    }

    public function headings(): array
    {
        $myLocale = App::getLocale();
        if ($myLocale == "es-MX") {
            return $this->headingsES; //spanish
        } elseif ($myLocale == "bn") {
            return $this->headingsBn; //Bangla
        } else {
            return $this->headings; //english
        }
    }

    public function query()
    {
        return Admission::query()
            ->leftJoin('classes', 'classes.id', 'admissions.class_id')
            ->leftJoin('pre_admissions', 'pre_admissions.id', 'admissions.preadmission_id')
            ->selectRaw('pre_admissions.year,roll,add_pass as password,admissions.name as student_name,mobile,father_name,mother_name,fathercell,placeBirth,dob,classes.name as class_name,CASE WHEN gender = 1 THEN "' . transMsg('Male') . '" ELSE CASE WHEN gender = 2 THEN "' . transMsg('Female') . '" ELSE "' . transMsg('Others') . '" END END as gender,CASE WHEN religon =1 THEN "' . transMsg('Islam') . '" ELSE CASE WHEN religon =2 THEN "' . transMsg('Hindu') . '" ELSE CASE WHEN religon =3 THEN "' . transMsg('Buddha') . '" ELSE CASE WHEN religon =4 THEN "' . transMsg('Christian') . '" ELSE "' . transMsg('Others') . '" END END END END,birthcertificateNo,CASE WHEN nationality = 14 THEN "Bangladeshi" ELSE nationality END')
            ->where('admissions.school_id', auth()->user()->school_id)
            ->where('admissions.status', $this->status)
            ->orderBy('roll', 'ASC');
    }
}
