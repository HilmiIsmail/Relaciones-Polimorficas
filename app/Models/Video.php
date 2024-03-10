<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'duracion', 'user_id'];

    //relcion 1:N con user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relacion polimorfica con Image
    public function image(): MorphOne
    {
        return $this->morphOne(
            Image::class,
            'imageable'
        );
    }

    //ACESSORES Y MUTTADORS
    public function nombre(): Attribute
    {
        return Attribute::make(
            set: fn ($v) => ucfirst($v),
        );
    }
}
