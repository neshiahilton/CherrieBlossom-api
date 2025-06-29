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
 *     description="Bouquet model",
 *     title="Bouquet model",
 *     required={"title", "author"},
 *     @OA\Xml(
 *         name="Bouquet"
 *     )
 * )
 */
class Bouquet extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'image',
        'description',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name of the bouquet",
     *     example="Lovely Roses"
     * )
     *
     * @var string
     */
    public $name;

 /**
     * @OA\Property(
     *     title="Category",
     *     description="Category of the bouquet",
     *     example="Valentine"
     * )
     *
     * @var string
     */
    public $category;

    /**
     * @OA\Property(
     *     title="Description",
     *     description="Description of the bouquet",
     *     example="A beautiful bouquet of red roses perfect for special moments."
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *     title="Price",
     *     description="Price of the bouquet",
     *     format="float",
     *     example=75000.00
     * )
     *
     * @var float
     */
    public $price;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;
    
    /**
     * @OA\Property(
     *     title="Deleted at",
     *     description="Deleted at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $deleted_at;
}