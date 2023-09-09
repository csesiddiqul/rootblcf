<?php

namespace App\Exports;

use App;
use App\User;
use App\Committee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CommitteesExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    private $headings = [
        'Name',
        'Email',
        'Phone',
        'Designation',
        'gender',
        'Status',
    ];
    private $headinsBn = [
        'নাম',
        'ইমেল',
        'ফোন',
        'পদবি',
        'লিঙ্গ',
        'স্টেটাস',
    ];

    private $headingsES = [
        'Nombre',
        'Correo',
        'Genero',
        'Codigo del Maestro',
        'Grupo Sanguineo',
        'Telefono',
        'Dirección',
    ];

    public function __construct(int $committeedesignation)
    {
        $this->designation = $committeedesignation;
    }

    public function headings(): array
    {
        $myLocale = App::getLocale();
        if ($myLocale == "es-MX") {
            return $this->headingsES; //spanish
        } elseif ($myLocale == "bn") {
            return $this->headinsBn; //Bangla
        } else {
            return $this->headings; //english
        }
    }

    public function query()
    {
        return Committee::query()
            ->select('name', 'email', 'mobile', 'designation', 'gender', 'status')
            ->bySchool(auth()->user()->school_id)
            ->whereDesignation($this->designation)
            ->orderBy('created_at');
    }
}
