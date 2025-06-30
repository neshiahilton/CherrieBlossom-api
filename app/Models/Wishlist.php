<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'bouquet_id'];

    public function bouquet()
    {
        return $this->belongsTo(Bouquet::class);
    }
}
