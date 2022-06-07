<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Uuid;

    protected $table = 'categories';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'title',
        'slug',
        'gallery_directory',
        'is_active',
        'in_home'
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'category_uuid', 'uuid');
    }

    public function tips()
    {
        return $this->hasMany(Tip::class, 'category_uuid', 'uuid');
    }
}
