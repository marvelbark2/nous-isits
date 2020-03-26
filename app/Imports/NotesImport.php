<?php

namespace App\Imports;

use App\Notes;
use Maatwebsite\Excel\Concerns\ToModel;

class NotesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row['0'] >= "10") {
            $ratt = 0;
        }else{
            $ratt = 1;
        }
        return new Notes([
            'note' => $row['0'],
            'element' => $row['1'],
            'code' =>  $row['2'],
            'type' => $row['3'],
            'date' => $row['4'],
            'rattr' => $ratt
        ]);
    }
}
