<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OpenApi\Annotations as OA;

/**
 * Class User.
 * 
 * @author Neshia Hilton <taneshia.422024002@civitas.ukrida.ac.id>
 * 
 * @OA\Schema(
 * schema="User",
 * title="User",
 * description="User model schema",
 * @OA\Property(property="id", type="integer", readOnly=true, example=1),
 * @OA\Property(property="name", type="string", example="John Doe"),
 * @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 * @OA\Property(property="email_verified_at", type="string", format="date-time", readOnly=true, nullable=true, example="2025-06-27T01:21:49.000000Z"),
 * @OA\Property(property="created_at", type="string", format="date-time", readOnly=true, example="2025-06-27T01:21:49.000000Z"),
 * @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true, example="2025-06-27T01:21:49.000000Z")
 * )
 */

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
