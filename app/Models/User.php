<?php

namespace App\Models;

use App\Models\Property;
use App\Models\PropertyTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];


    /*
    |--------------------------------------------------------------------------
    | HIDDEN FIELDS
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];


    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTE CASTS
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | OWNED / LISTED PROPERTIES
    |--------------------------------------------------------------------------
    |
    | user_id = jis User/Owner ne property create/list ki hai.
    |
    */

    public function ownedProperties()
    {
        return $this->hasMany(
            Property::class,
            'user_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROPERTIES ALIAS
    |--------------------------------------------------------------------------
    |
    | Owner listing ke liye use ho raha hai:
    |
    | withCount('properties')
    |
    | Isse properties_count available hoga.
    |
    */

    public function properties()
    {
        return $this->hasMany(
            Property::class,
            'user_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ASSIGNED AGENT PROPERTIES
    |--------------------------------------------------------------------------
    |
    | agent_id = jis Agent ko property assign ki gayi hai.
    |
    | Agent listing me total assigned properties
    | count karne ke liye isi relationship ka use hoga.
    |
    */

    public function assignedProperties()
    {
        return $this->hasMany(
            Property::class,
            'agent_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROPERTY TRANSACTIONS
    |--------------------------------------------------------------------------
    */

    public function propertyTransactions()
    {
        return $this->hasMany(
            PropertyTransaction::class
        );
    }
}