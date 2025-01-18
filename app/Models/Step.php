<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends TranslatableModel
{
    use HasFactory;

    protected $fillable = ['section_id', 'optional', 'position', 'live'];

    protected $translationModel = StepTranslation::class;
    protected $translationAttributes = ['title', 'subtext'];
    protected $translationForeignKey = 'step_id';

    /**
     * The step section.
     */
    public function section() {
        return $this->belongsTo(Section::class);
    }
}

class StepTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['step_id', 'lang_id', 'title', 'subtext'];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
