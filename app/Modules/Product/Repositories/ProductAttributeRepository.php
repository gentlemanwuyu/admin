<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/19
 * Time: 12:05
 */

namespace App\Modules\Product\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Product\Models\ProductAttribute;
use App\Traits\RepositoryTrait;

class ProductAttributeRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return ProductAttribute::class;
    }
}