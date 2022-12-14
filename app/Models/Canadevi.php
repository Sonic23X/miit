<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canadevi extends Model
{
    use HasFactory;

    public const VIRTUAL = 0;
    public const PRESENT = 1;

    public const MODE_TRANS = 1;
    public const MODE_CARD = 2;
    public const MODE_FIS = 3;
    public const MODE_INV = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hash',
        'name',
        'first_surname',
        'second_surname',
        'telephone',
        'email',
        'birthdate',
        'company',
        'position',
        'mode',
        'payment_mode',
        'payment_status',
        'conekta_url',
        'assistance'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthdate' => 'date',
    ];
}
