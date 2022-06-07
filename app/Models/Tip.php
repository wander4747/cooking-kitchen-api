<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory, Uuid;

    protected $table = 'tips';
    
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'title',
        'slug',
        'gallery_directory',
        'category_uuid',
        'tip'
    ];
}
