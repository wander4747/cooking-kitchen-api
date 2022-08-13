<?php
namespace App\Repositories\Admin\Eloquent;

use App\Models\Category;
use App\Repositories\Admin\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    protected $model = Category::class;
}
