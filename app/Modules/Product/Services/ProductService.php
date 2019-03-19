<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/11
 * Time: 11:27
 */

namespace App\Modules\Product\Services;

use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Product\Repositories\ProductSkuRepository;
use App\Modules\Product\Repositories\ProductAttributeRepository;
use App\Modules\Product\Repositories\ProductSkuAttributeValueRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductService
{
    protected $productRepository;
    protected $productSkuRepository;
    protected $productAttributeRepository;
    protected $productSkuAttributeValueRepository;

    public function __construct(ProductRepository $productRepository,
                                ProductSkuRepository $productSkuRepository,
                                ProductAttributeRepository $productAttributeRepository,
                                ProductSkuAttributeValueRepository $productSkuAttributeValueRepository)
    {
        $this->productRepository = $productRepository;
        $this->productSkuRepository = $productSkuRepository;
        $this->productAttributeRepository = $productAttributeRepository;
        $this->productSkuAttributeValueRepository = $productSkuAttributeValueRepository;
    }

    public function getProductList()
    {
        return $this->productRepository->paginate();
    }

    public function createOrUpdateProduct($request)
    {
        try {
            DB::beginTransaction();
            $base_data = [
                'code' => $request->get('code'),
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'category_id' => $request->get('category_id'),
                'image_link' => $request->get('image_link'),
            ];
            $product = $this->productRepository->create($base_data);
            if (!$product) {
                throw new \Exception('Create product failed.');
            }

            $product_attributes = [];
            if ($request->get('product_attributes')) {
                foreach ($request->get('product_attributes') as $index => $i_product_attribute) {
                    $product_attribute = $this->productAttributeRepository->create([
                        'product_id' => $product->id,
                        'name' => $i_product_attribute['name'],
                        'is_required' => isset($i_product_attribute['is_required']) ? $i_product_attribute['is_required'] : 0,
                    ]);
                    if (!$product_attribute) {
                        throw new \Exception('Create product attribute failed.');
                    }
                    $product_attributes[$index] = $product_attribute;
                }
            }

            if ($request->get('skus')) {
                foreach ($request->get('skus') as $i_sku) {
                    $sku = $this->productSkuRepository->create([
                        'product_id' => $product->id,
                        'code' => $i_sku['code'],
                        'weight' => $i_sku['weight'],
                        'cost_price' => $i_sku['cost_price'],
                    ]);
                    if (!$sku) {
                        throw new \Exception('Create product sku failed.');
                    }

                    if ($i_sku['attributes']) {
                        foreach ($i_sku['attributes'] as $index => $value) {
                            $this->productSkuAttributeValueRepository->create([
                                'product_id' => $product->id,
                                'sku_id' => $sku->id,
                                'attribute_id' => $product_attributes[$index]->id,
                                'value' => $value,
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 读取产品信息
     *
     * @param $product_id
     * @return mixed
     */
    public function getProduct($product_id)
    {
        return $this->productRepository->find($product_id);
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