<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'user_id'];

    //Relacion polymorfica con image
    public function image(): MorphOne
    {
        return $this->morphOne(
            Image::class,
            'imageable'
        );
    }

    //relcion 1:N con user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
