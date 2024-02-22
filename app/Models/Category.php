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

    public static function allChildrenIds(Model $model, array &$childs = [], $processed = []): array
    {
        if (!empty($model->children)) {
            foreach ($model->children as $child) {
                $childId = $child['id'];
                if (!in_array($childId, $processed)) {
                    $processed[] = $childId;
                    $childs[] = $childId;
                    if (!empty($child['children'])) {
                        $childIds = static::allChildrenIds($child, $processed); // Recursively get child IDs
                        $childs = array_merge($childs, $childIds); // Merge child IDs with current IDs
                    }
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
