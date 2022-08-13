<?php
namespace Tests\Unit\App\Models;

use App\Models\Recipe;
use PHPUnit\Framework\TestCase;

class RecipeTest extends TestCase
{
    public function testFillables()
    {
        $expected = [
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

        $model = new Recipe();
        $this->assertEquals($expected, $model->getFillable());
    }
}
