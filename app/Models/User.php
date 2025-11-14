<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the user's initials from their name.
     * 
     * @return string
     */
    public function initials(): string
    {
        $name = $this->name ?? 'U';
        $words = explode(' ', trim($name));
        
        if (count($words) >= 2) {
            // Si tiene dos o más palabras, toma la primera letra de cada una
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        
        // Si solo tiene una palabra, toma las dos primeras letras
        return strtoupper(substr($name, 0, 2));
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}