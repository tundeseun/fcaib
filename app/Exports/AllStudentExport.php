<?php

namespace App\Exports;

use App\SmStudent;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class AllStudentExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return[
            'matric_number',
            'first_name',
            'last_name',
            'date_of_birth',
            'gender',
            'mobile',
            'email',
            'admission_date',
            'department',
            'level',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $all_student_data = [];
        $student_infos = SmStudent::where('school_id',Auth::user()->school_id)->orderBy('class_id','asc')
                    ->get();
        foreach($student_infos as $student_info){
            $all_student_data[] = [
                $student_info->matric_number,
                $student_info->first_name,
                $student_info->last_name,
                $student_info->date_of_birth,
                $student_info->gender->base_setup_name,
                @$student_info->mobile,
                $student_info->email,
                $student_info->admission_date,
                $student_info->class->class_name,
                $student_info->section->section_name,
            ];
        }

        return collect($all_student_data);
    }
}
