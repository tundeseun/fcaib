<?php

namespace App\Imports;

use App\GraduandBulkTemporary;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class GraduandsImport implements ToModel, WithStartRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GraduandBulkTemporary([
          "matric_number"   => @$row['matric_number'],
          "cgpa"           => @$row['cgpa'],
          "class_of_degree" => @$row['class_of_degree'],
          "user_id"         => Auth::user()->id
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function headingRow(): int
    {
        return 1;
    }
}