<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // validation
        $validator = Validator::make($row, [
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20|unique:customers,phone',
            'email'      => 'nullable|email|max:255',
            'job'        => 'nullable|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'floor_id'   => 'nullable',
            'unit_id'    => 'nullable',
            'budget'     => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return null;  
        }

        return new Customer([
            'name'       => $row['name'],
            'phone'      => $row['phone'],
            'email'      => $row['email'] ?? null,
            'job'        => $row['job'] ?? null,
            'project_id' => $row['project_id'] ?? null,
            'floor_id'   => $row['floor_id'] ?? null,
            'unit_id'    => $row['unit_id'] ?? null,
            'budget'     => $row['budget'] ?? null,
        ]);
    }
}
