<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/11
 * Time: 11:27
 */

namespace App\Modules\Product\Services;

use App\Modules\Product\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProductList()
    {
        return $this->productRepository->paginate();
    }

    /**
     * 上传图片链接
     *
     * @param $request
     * @return array
     */
    public function uploadImageLink($request)
    {
        try {
            if (!$request->hasFile('file')) {
                throw new \Exception('None file uploaded.');
            }

            $file = $request->file('file');

            $image_size = getimagesize($file->getRealPath());
            if ($image_size[0] != $image_size[1]) {
                throw new \Exception(trans('product::product.required_square_image'));
            }

            $file_name = uniqid().'.'.$file->extension();

            Storage::disk('public')->put('uploads/product/'.$file_name, file_get_contents($file->getRealPath()));

            return ['status' => 'success', 'content' => asset('/storage/uploads/product/'.$file_name)];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}