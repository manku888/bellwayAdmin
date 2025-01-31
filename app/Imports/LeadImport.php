<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class LeadImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Lead([
            'assignee'        => $row['assignee'],
            'service'         => $row['service'],
            'status'          => $row['status'],
            'source'          => $row['source'],
            'budget'          => $row['budget'],
            'full_name'       => $row['full_name'],
            'phone_number'    => $row['phone_number'],
            'city'            => $row['city'],
            'email'           => $row['email'],
            'description'     => $row['description'],
            'last_follow_up_date' => Carbon::parse($row['last_follow_up_date']),
            'follow_up_date'  => Carbon::parse($row['follow_up_date']),
        ]);
    }

    public function rules(): array
    {
        return [
            'assignee' => 'required',
            'service' => 'required',
            'status' => 'required',
            'source' => 'required',
            'full_name' => 'required',
            'phone_number' => 'required',
        ];
    }
}
