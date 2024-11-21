<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    
    protected $translationForeignKey = 'post_id';
    public $translatedAttributes = ['title', 'content'];
    protected $translationModel = PostTranslation::class;
    protected $fillable = [ 'created_at' ];
}