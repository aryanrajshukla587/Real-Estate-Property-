<?php

namespace App\Models;

use App\Models\PropertyTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',

        'title',

        'slug',

        'property_type_id',

        'agent_id',

        'location_id',

        'purpose',

        'price',

        'area',

        'bedrooms',

        'bathrooms',

        'garages',

        'address',

        'description',

        'photos',

        'status',

        'approval_status',

        'is_featured',

        'is_active',
    ];


    protected $casts = [

        'price' => 'decimal:2',

        'area' => 'decimal:2',

        'photos' => 'array',

        'is_featured' => 'boolean',

        'is_active' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | Property Owner / Lister
    |--------------------------------------------------------------------------
    |
    | user_id = jis User/Owner ne property create/list ki hai.
    |
    */

    public function owner()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Property Type
    |--------------------------------------------------------------------------
    */

    public function propertyType()
    {
        return $this->belongsTo(
            PropertyType::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Location
    |--------------------------------------------------------------------------
    */

    public function location()
    {
        return $this->belongsTo(
            Location::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Assigned Agent
    |--------------------------------------------------------------------------
    |
    | agent_id = optional assigned Agent.
    |
    */

    public function agent()
    {
        return $this->belongsTo(
            User::class,
            'agent_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Property Transactions
    |--------------------------------------------------------------------------
    */

    public function transactions()
    {
        return $this->hasMany(
            PropertyTransaction::class
        );
    }
}