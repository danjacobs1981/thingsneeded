<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thing extends TranslatableModel
{
    use HasFactory;

    protected $fillable = ['page_id', 'type_id', 'purchasable', 'position', 'live'];

    protected $translationModel = ThingTranslation::class;
    protected $translationAttributes = ['title', 'subtext', 'search_phrase'];
    protected $translationForeignKey = 'thing_id';
}

class ThingTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['thing_id', 'lang_id', 'title', 'subtext', 'search_phrase'];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
