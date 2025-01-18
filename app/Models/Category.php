<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends TranslatableModel
{
    use HasFactory;

    protected $fillable = ['slug'];

    public $timestamps = false;

    protected $translationModel = CategoryTranslation::class;
    protected $translationAttributes = ['category'];
    protected $translationForeignKey = 'category_id';

    /**
     * The pages that belong to the category.
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
    public function pagesTranslation()
    {
        return $this->hasMany(Page::class)->withTranslation();
    }
}

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'lang_id', 'category'];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
