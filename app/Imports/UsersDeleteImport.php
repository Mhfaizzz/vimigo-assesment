<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersDeleteImport implements ToCollection, WithHeadingRow
{
    
    public function collection(Collection $rows)
    {
        //loop for each row in excel
        foreach ($rows as $row) 
        {
            $delete = User::find($row['id'])->delete();
        }
    }
}
