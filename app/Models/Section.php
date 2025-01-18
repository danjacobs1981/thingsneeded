<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends TranslatableModel
{
    use HasFactory;

    protected $fillable = ['page_id', 'position', 'live'];

    protected $translationModel = SectionTranslation::class;
    protected $translationAttributes = ['title'];
    protected $translationForeignKey = 'section_id';

    /**
     * The steps that belong to the section.
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}

class SectionTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'lang_id', 'title'];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
