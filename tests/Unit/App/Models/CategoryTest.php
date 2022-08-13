<?php
namespace Tests\Unit\App\Models;

use App\Models\Category;
use App\Models\Recipe;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testFillables()
    {
        $expected = [
            'title',
            'slug',
            'gallery_directory',
            'is_active',
            'in_home'
        ];

        $model = new Category();
        $this->assertEquals($expected, $model->getFillable());
    }

    public function testRecipes()
    {
        $category = Category::factory()->create();
        $recipe = Recipe::factory()->create(['category_uuid' => $category->uuid]);

        $this->assertTrue($category->recipes->contains($recipe));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->recipes);
    }
}
