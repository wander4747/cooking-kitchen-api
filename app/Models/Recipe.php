<?php
namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory, Uuid;

    protected $table = 'recipes';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'title',
        'slug',
        'category_uuid',
        'gallery_directory',
        'preparation_time',
        'difficulty',
        'number_of_people_served',
        'ingredients',
        'preparation_mode',
        'is_active'
    ];
}
