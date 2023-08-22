<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Inv extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'inv_code', 'title', 'slug', 'stock'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the user that owns the Inv
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'inv_categories', 'inv_id', 'category_id');
    }



}
