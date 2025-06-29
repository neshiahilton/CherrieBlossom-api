<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * Class Book.
 *
 * @author Neshia Hilton <taneshia.422024002@civitas.ukrida.ac.id>
 * 
 * @OA\Schema(
 *     description="Book model",
 *     title="Book model",
 *     required={"title", "author"},
 *     @OA\Xml(
 *         name="Book"
 *     )
 * )
 */

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    // --- RELASI PENGGUNA ---

    /**
     * Relasi User yang membuat buku
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Relasi User yang mengubah buku
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Relasi User yang menghapus buku
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}