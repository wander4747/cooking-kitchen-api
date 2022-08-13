<?php
namespace App\Repositories\Admin\Eloquent;

use App\Models\Tip;
use App\Repositories\Admin\Contracts\TipRepositoryInterface;

class TipRepository extends AbstractRepository implements TipRepositoryInterface
{
    protected $model = Tip::class;
}
