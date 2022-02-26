<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Movie extends Model
{
    use HasFactory;
    use HasTranslations;

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
    protected $guarded = ['id'];

    public $translatable = ['name'];
}
