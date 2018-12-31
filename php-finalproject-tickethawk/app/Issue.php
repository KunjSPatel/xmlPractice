<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Issue extends Model implements FromCollection, WithHeadings
{
    protected $fillable = ['name'];

    public function tickets() {
        return $this->belongsToMany(Ticket::class, 'ticket_issue');
    }

    public function collection() {
        return Issue::all();
    }

    public function headings(): array
    {
        return [
            'ID #',
            'NAME',
        ];
    }
}
