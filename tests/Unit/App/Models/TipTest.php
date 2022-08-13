<?php
namespace Tests\Unit\App\Models;

use App\Models\Tip;
use PHPUnit\Framework\TestCase;

class TipTest extends TestCase
{
    public function testFillables()
    {
        $expected = [
            'title',
            'slug',
            'gallery_directory',
            'category_uuid',
            'tip'
        ];

        $model = new Tip();
        $this->assertEquals($expected, $model->getFillable());
    }
}
