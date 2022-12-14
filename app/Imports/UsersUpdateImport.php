<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersUpdateImport implements ToCollection, WithHeadingRow
{
    
    public function collection(Collection $rows)
    {
        //loop for each row in excel
        foreach ($rows as $row) 
        {
            //update the records according to the id
            $update = User::find($row['id']);
            $update ->update([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'updated_at' => NOW(),
            
            ]);
            
            
           
        }
    }
}
