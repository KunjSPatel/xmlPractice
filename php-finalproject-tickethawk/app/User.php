<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements FromCollection, WithHeadings
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function collection() {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'ID #',
            'NAME',
            'EMAIL',
            '',
            'CREATED_AT',
            'UPDATED_AT',
        ];
    }
}
