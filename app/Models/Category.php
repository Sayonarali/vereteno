<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'level',
        'parent_id'
    ];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function image()
    {
        return $this->hasOne(CategoryImage::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public static function allChildrenIds(Model $model, array &$childs = []): array
    {
        if (!empty($model->children)) {
            foreach ($model->children as $child) {
                $childs[] = $child['id'];
//                dd($child->children);
                if ($child->children) {
                    static::allChildrenIds($child, $childs);
                }
            }
        }
        return $childs;
    }

    public static function allChildren(Model $model, array &$childs = [])
    {
        foreach ($model->children as $child) {
            $childs[] = $child;
            static::allChildren($child, $childs);
        }
        return $childs;
    }
}
