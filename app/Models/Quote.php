<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quote extends Model
{
    use HasFactory;
    use HasFactory, HasTranslations;

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    protected $guarded = ['id'];

    public $translatable = ['text'];
}
