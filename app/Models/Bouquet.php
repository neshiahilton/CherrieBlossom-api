<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use OpenApi\Annotations as OA;

/**
 * Class Bouquet.
 * 
 * @author Neshia Hilton <taneshia.422024002@civitas.ukrida.ac.id>
 * 
 * @OA\Schema(
 * schema="Bouquet",
 * required={"name", "price", "stock"},
 * @OA\Property(
 * property="id",
 * type="integer",
 * readOnly=true,
 * description="The unique identifier for the bouquet."
 * ),
 * @OA\Property(
 * property="name",
 * type="string",
 * description="The name of the bouquet."
 * ),
 * @OA\Property(
 * property="description",
 * type="string",
 * description="A detailed description of the bouquet."
 * ),
 * @OA\Property(
 * property="price",
 * type="number",
 * format="float",
 * description="The price of the bouquet."
 * ),
 * @OA\Property(
 * property="stock",
 * type="integer",
 * description="The available stock of the bouquet."
 * ),
 * @OA\Property(
 * property="image",
 * type="string",
 * description="URL or path to the bouquet image."
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * readOnly=true,
 * description="Creation timestamp."
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * readOnly=true,
 * description="Last update timestamp."
 * )
 * )
 */

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