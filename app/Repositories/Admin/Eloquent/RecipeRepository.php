<?php

namespace App\Repositories\Admin\Eloquent;

use App\Models\Recipe;
use App\Repositories\Admin\Contracts\RecipeRepositoryInterface;

class RecipeRepository extends AbstractRepository implements RecipeRepositoryInterface
{

    protected $model = Recipe::class;


}
