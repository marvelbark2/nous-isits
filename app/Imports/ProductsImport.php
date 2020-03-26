<?php

namespace App\Imports;

use App\Products;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Products([
            'gid' => $row[1],
            'product' => $row[2],
            'price' => $row[3],
            'brand' => $row[4],
            'categorie' => $row[5],
            'image' => $row[6]
        ]);
    }
}
