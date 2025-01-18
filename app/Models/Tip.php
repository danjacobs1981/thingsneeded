<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends TranslatableModel
{
    use HasFactory;

    protected $fillable = ['page_id', 'position', 'live'];

    protected $translationModel = TipTranslation::class;
    protected $translationAttributes = ['title', 'subtext'];
    protected $translationForeignKey = 'tip_id';
}

class TipTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['tip_id', 'lang_id', 'title', 'subtext'];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
