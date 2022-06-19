<?php

namespace App\Repositories\Admin\Eloquent;

use App\Models\Tip;
use App\Repositories\Admin\Contracts\RecipeRepositoryInterface;

class TipRepository extends AbstractRepository implements RecipeRepositoryInterface
{
    protected $model = Tip::class;
}
