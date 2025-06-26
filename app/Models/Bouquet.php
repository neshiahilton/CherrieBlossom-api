<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Bouquet extends Model
{
    use SoftDeletes;

    protected $table = 'bouquets';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relasi: Mendapatkan data user yang membuat buket ini.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Relasi: Mendapatkan data user yang mengubah buket ini.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Relasi: Mendapatkan data user yang menghapus buket ini.
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}