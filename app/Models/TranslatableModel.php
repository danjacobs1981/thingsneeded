<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class TranslatableModel extends Model
{
    protected $translationForeignKey;
    protected $translationModel;
    protected $translationAttributes = [];

    public function translations()
    {
        return $this->hasMany($this->translationModel);
    }

    public static function scopeWithTranslation(Builder $query, $languageCode = null)
    {
        $languageCode = $languageCode ?: app()->getLocale();
        $instance = new static;
        $translationModel = $instance->translationModel;
        $translationTable = (new $translationModel)->getTable();
        $mainTable = $instance->getTable();

        $query->select("$mainTable.*");

        foreach ($instance->translationAttributes as $attribute) {
            $query->addSelect("$translationTable.$attribute");
        }

        return $query->join($translationTable, "$mainTable.id", '=', "$translationTable.$instance->translationForeignKey")
            ->join('languages', "$translationTable.lang_id", '=', 'languages.id')
            ->where('languages.code', $languageCode);
    }
}
