<?php

namespace App\Imports;

use App\ResultBulkTemporary;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class ResultsImport implements ToModel, WithStartRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ResultBulkTemporary([
          "matric_number"   => @$row['matric_number'],
          "score"           => @$row['score'],
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