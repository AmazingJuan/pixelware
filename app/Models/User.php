<?php

/*
 * User.php
 * Model for managing users in the application.
 * Author: Santiago Manco
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Attributes:
     *
     * $this->attributes['id']                  - int                        - Primary key identifier
     * $this->attributes['username']            - string                     - Unique username
     * $this->attributes['email']               - string                     - User email
     * $this->attributes['email_verified_at']   - \Illuminate\Support\Carbon|null - Email verification timestamp
     * $this->attributes['password']            - string                     - Hashed password
     * $this->attributes['address']             - array|null                 - User address (JSON)
     * $this->attributes['chat_history_ai']     - array|null                 - AI chat history (JSON)
     * $this->attributes['balance']             - int                        - Account balance
     * $this->attributes['role']                - string                     - User role ('admin' or 'customer')
     * $this->attributes['remember_token']      - string|null                - Token for "remember me" sessions
     * $this->attributes['created_at']          - \Illuminate\Support\Carbon - Record creation timestamp
     * $this->attributes['updated_at']          - \Illuminate\Support\Carbon - Record last update timestamp
     */
    protected $fillable = [
        'username',
        'email',
        'email_verified_at',
        'password',
        'address',
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
        'chat_history_ai' => 'array',
        'email_verified_at' => 'datetime',
    ];

    // Getters.

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUsername(): string
    {
        return $this->attributes['username'];
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function getEmailVerifiedAt(): ?Carbon
    {
        return $this->attributes['email_verified_at'];
    }

    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function getAddress(): ?array
    {
        return $this->attributes['address'];
    }

    public function getChatHistoryAi(): ?array
    {
        return $this->attributes['chat_history_ai'];
    }

    public function getBalance(): int
    {
        return $this->attributes['balance'];
    }

    public function getRole(): string
    {
        return $this->attributes['role'];
    }

    public function getRememberToken(): ?string
    {
        return $this->attributes['remember_token'];
    }

    public function getCreatedAt(): Carbon
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->attributes['updated_at'];
    }

    // Setters.

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setUsername(string $username): void
    {
        $this->attributes['username'] = $username;
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function setEmailVerifiedAt(?Carbon $email_verified_at): void
    {
        $this->attributes['email_verified_at'] = $email_verified_at;
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    public function setAddress(?array $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function setChatHistoryAi(?array $chat_history_ai): void
    {
        $this->attributes['chat_history_ai'] = $chat_history_ai;
    }

    public function setBalance(int $balance): void
    {
        $this->attributes['balance'] = $balance;
    }

    public function setRole(string $role): void
    {
        $this->attributes['role'] = $role;
    }

    public function setRememberToken($value)
    {
        $this->attributes['remember_token'] = $value;
    }

    public function setCreatedAt($value): void
    {
        parent::setCreatedAt($value);
    }

    public function setUpdatedAt($value): void
    {
        parent::setUpdatedAt($value);
    }

    // Relationships.

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Util methods.

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }
}
