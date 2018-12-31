<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Ticket extends Model implements FromCollection, WithHeadings
{
    protected $fillable = ['user_id', 'status', 'description', 'urgency', 'department', 'created_at', 'updated_at'];

    public function issues() {
        return $this->belongsToMany(Issue::class, 'ticket_issue');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->paginate(5);
    }

    public function collection() {
        return Ticket::all();
    }

    public function headings(): array
    {
        return [
            'ID #',
            'USER ID',
            'STATUS',
            'DESCRIPTION',
            'URGENCY',
            'DEPARTMENT_LOCATION',
            'CREATED_AT',
            'UPDATED_AT',
        ];
    }
}
