<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends TranslatableModel
{
    use HasFactory;

    protected $translationModel = TypeTranslation::class;
    protected $translationAttributes = ['type', 'title'];
    protected $translationForeignKey = 'type_id';
}

class TypeTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'lang_id', 'type', 'title'];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
