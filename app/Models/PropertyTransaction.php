<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'type',

        // Property listed/original price
        'amount',

        // Customer offered amount
        'offer_amount',

        // Admin counter offer amount
        'counter_offer_amount',

        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'status',
        'admin_note',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'offer_amount' => 'decimal:2',
        'counter_offer_amount' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | PROPERTY
    |--------------------------------------------------------------------------
    */

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}