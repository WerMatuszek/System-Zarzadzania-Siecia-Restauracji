<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rezerwacje extends Model
{
    use HasFactory;

    protected $table = 'rezerwacjes';

    protected $fillable = [
        'name_res',
        'last_name_res',
        'hour_start',
        'hour_end',
        'table_nr',
        'guest_nr',
        'date_res',
        'restauracja'
    ];
}
