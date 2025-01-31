<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Lead::all();
    }

    public function headings(): array
    {
        return [
            'Assignee',
            'Service',
            'Status',
            'Source',
            'Budget',
            'Full Name',
            'Phone Number',
            'City',
            'Email',
            'Description',
            'Last Follow Up Date',
            'Follow Up Date'
        ];
    }

    public function map($lead): array
    {
        return [
            $lead->assignee,
            $lead->service,
            $lead->status,
            $lead->source,
            $lead->budget,
            $lead->full_name,
            $lead->phone_number,
            $lead->city,
            $lead->email,
            $lead->description,
            $lead->last_follow_up_date,
            $lead->follow_up_date
        ];
    }
}
