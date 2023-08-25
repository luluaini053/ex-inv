<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depart extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'depart','slug'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'depart'
            ]
        ];
    }
}
