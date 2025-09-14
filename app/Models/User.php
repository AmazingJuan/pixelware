<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Attributes:
     *
     * $this->attributes['id']                  - int                        - Primary key identifier
     * $this->attributes['username']            - string                     - Unique username
     * $this->attributes['password']            - string                     - Hashed password
     * $this->attributes['email']               - string                     - User email
     * $this->attributes['name']                - string                     - Full name
     * $this->attributes['address']             - array|null                 - User address (JSON)
     * $this->attributes['credit_card_details'] - array|null                 - Credit card info (JSON)
     * $this->attributes['chat_history_ai']     - array|null                 - AI chat history (JSON)
     * $this->attributes['balance']             - int                        - Account balance
     * $this->attributes['role']                - string                     - User role ('admin' or 'customer')
     * $this->attributes['remember_token']      - string|null                - Token for "remember me" sessions
     * $this->attributes['created_at']          - \Illuminate\Support\Carbon  - Record creation timestamp
     * $this->attributes['updated_at']          - \Illuminate\Support\Carbon  - Record last update timestamp
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'name',
        'address',
        'credit_card_details',
        'chat_history_ai',
        'balance',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'address' => 'array',
        'credit_card_details' => 'array',
        'chat_history_ai' => 'array',
    ];

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }
}
