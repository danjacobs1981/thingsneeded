<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends TranslatableModel
{
    use HasFactory;

    protected $fillable = ['id', 'input_topic', 'input_prompt', 'slug', 'reading_time', 'category_id', 'author_id', 'image', 'edited', 'translated', 'products', 'live', 'editmode', 'batch', 'gemini_model'];

    protected $translationModel = PageTranslation::class;
    protected $translationAttributes = ['title', 'introduction', 'conclusion'];
    protected $translationForeignKey = 'page_id';

    /**
     * The pages with translations.
     */
    public function pages()
    {
        return $this->withTranslation();
    }

    /**
     * The page author.
     */
    public function author() {
        return $this->belongsTo(Author::class)->first();
    }

    /**
     * The page category.
     */
    public function category() {
        return $this->belongsTo(Category::class)->withTranslation()->first();
    }

    /**
     * The things that belong to the page.
     */
    public function things()
    {
        return $this->hasMany(Thing::class)->withTranslation();
    }

    /**
     * The additional tips that belong to the page.
     */
    public function tips()
    {
        return $this->hasMany(Tip::class)->withTranslation();
    }

    /**
     * The (step) sections that belong to the page.
     */
    public function sections()
    {
        return $this->hasMany(Section::class)->withTranslation();
    }

    /**
     * The tags that belong to the page.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_page')->withTranslation();
    }

    public function tagsBasic()
    {
        return $this->belongsToMany(Tag::class, 'tag_page');
    }

    public function relatedPagesByTag()
    {
        return Page::whereHas('tagsBasic', function ($query) {
            $tagIds = $this->tagsBasic()->pluck('tags.id')->all();
            $query->whereIn('tags.id', $tagIds);
        })->where('id', '<>', $this->id);
    }

}

class PageTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'lang_id', 'title', 'introduction', 'conclusion', 'introduction_humanized', 'conclusion_humanized', 'introduction_gemini', 'conclusion_gemini'];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
