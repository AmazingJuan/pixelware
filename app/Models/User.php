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
     * $this->attributes['chat_history_ai']     - array|null                 - AI chat history (JSON)
     * $this->attributes['balance']             - int                        - Account balance
     * $this->attributes['role']                - string                     - User role ('admin' or 'customer')
     * $this->attributes['remember_token']      - string|null                - Token for "remember me" sessions
     * $this->attributes['created_at']          - \Illuminate\Support\Carbon - Record creation timestamp
     * $this->attributes['updated_at']          - \Illuminate\Support\Carbon - Record last update timestamp
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'name',
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

    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
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

    // Setters.

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setUsername(string $username): void
    {
        $this->attributes['username'] = $username;
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
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
