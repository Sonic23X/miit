<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ampi extends Model
{
    use HasFactory;

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
        'real_estate',
        'is_partner',
        'region',
        'payment_mode',
        'payment_status',
        'conekta_url',
        'assistance',
        'coupon_id'
    ];
}
