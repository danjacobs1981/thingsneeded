<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends TranslatableModel
{
    use HasFactory;

    protected $fillable = ['slug'];

    public $timestamps = false;

    protected $translationModel = TagTranslation::class;
    protected $translationAttributes = ['tag'];
    protected $translationForeignKey = 'tag_id';

    protected $hidden = ['pivot'];

    /**
     * The pages that belong to the tag.
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'tag_page');
    }
    public function pagesTranslation()
    {
        return $this->belongsToMany(Page::class, 'tag_page')->withTranslation();
    }
}

class TagTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'lang_id', 'tag'];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

}
