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
use App\Modules\Product\Repositories\Criteria\Product\CodeOrNameLike;
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

    public function getProductList($request)
    {
        $this->productRepository->pushCriteria(new CodeOrNameLike($request->get('search')));

        return $this->productRepository->paginate();
    }

    /**
     * 写入/修改产品数据
     *
     * @param $request
     * @return array
     */
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
            // 写入/更新产品数据
            if ('update' == $request->get('action')) {
                $product = $this->productRepository->update($base_data, $request->get('product_id'));
            }else {
                $product = $this->productRepository->create($base_data);
            }
            if (!$product) {
                throw new \Exception('Create product failed.');
            }

            // 同步产品属性
            $product_attributes = [];
            // 产品原本的属性
            $ori_product_attribute_ids = array_column($this->productAttributeRepository->findByField('product_id', $product->id)->toArray(), 'id');
            $new_product_attribute_ids = [];
            if ($request->get('product_attributes')) {
                foreach ($request->get('product_attributes') as $index => $i_product_attribute) {
                    $data = [
                        'product_id' => $product->id,
                        'name' => $i_product_attribute['name'],
                        'is_required' => isset($i_product_attribute['is_required']) ? $i_product_attribute['is_required'] : 0,
                    ];
                    if ($this->productAttributeRepository->findByField('id', $index)->isEmpty()) {
                        $product_attribute = $this->productAttributeRepository->create($data);
                    }else {
                        $product_attribute = $this->productAttributeRepository->update($data, $index);
                    }
                    if (!$product_attribute) {
                        throw new \Exception('Create product attribute failed.');
                    }
                    $new_product_attribute_ids[] = $product_attribute->id;
                    $product_attributes[$index] = $product_attribute;
                }
            }

            // 删除产品属性的差集
            $diff_product_attribute_ids = array_diff($ori_product_attribute_ids, $new_product_attribute_ids);
            $this->productAttributeRepository->destroy($diff_product_attribute_ids);

            $ori_product_sku_ids = array_column($this->productSkuRepository->findByField('product_id', $product->id)->toArray(), 'id');
            $new_product_sku_ids = [];
            if ($request->get('skus')) {
                foreach ($request->get('skus') as $index => $i_sku) {
                    if ($this->productSkuRepository->findByField('id', $index)->isEmpty()) {
                        $sku = $this->productSkuRepository->create([
                            'product_id' => $product->id,
                            'code' => $i_sku['code'],
                            'weight' => $i_sku['weight'],
                            'cost_price' => $i_sku['cost_price'],
                        ]);
                    }else {
                        $sku = $this->productSkuRepository->update([
                            'code' => $i_sku['code'],
                            'weight' => $i_sku['weight'],
                            'cost_price' => $i_sku['cost_price'],
                        ], $index);
                    }
                    if (!$sku) {
                        throw new \Exception('Create product sku failed.');
                    }
                    $new_product_sku_ids[] = $sku->id;

                    if ($i_sku['attributes']) {
                        foreach ($i_sku['attributes'] as $index => $value) {
                            $sku_attribute_value = $this->productSkuAttributeValueRepository->findWhere([
                                'sku_id' => $sku->id,
                                'attribute_id' => $index,
                            ])->first();
                            if (!$sku_attribute_value) {
                                $this->productSkuAttributeValueRepository->create([
                                    'product_id' => $product->id,
                                    'sku_id' => $sku->id,
                                    'attribute_id' => $product_attributes[$index]->id,
                                    'value' => $value,
                                ]);
                            }else {
                                $this->productSkuAttributeValueRepository->update([
                                    'value' => $value,
                                ], $sku_attribute_value->id);
                            }
                        }
                    }
                }
            }

            $diff_product_sku_ids = array_diff($ori_product_sku_ids, $new_product_sku_ids);
            $this->productSkuRepository->destroy($diff_product_sku_ids);

            // 删除无关的属性值
            $deleted_sku_values = $this->productSkuAttributeValueRepository->findWhereIn('sku_id', $diff_product_sku_ids)->toArray();
            $deleted_attribute_values = $this->productSkuAttributeValueRepository->findWhereIn('attribute_id', $diff_product_attribute_ids)->toArray();
            $delete_value_ids = array_merge(array_column($deleted_sku_values, 'id'), array_column($deleted_attribute_values, 'id'));
            $this->productSkuAttributeValueRepository->destroy($delete_value_ids);

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

    /**
     * 删除产品
     *
     * @param $request
     * @return array
     */
    public function deleteProduct($request)
    {
        try {
            DB::beginTransaction();
            $this->productRepository->delete($request->get('product_id'));
            $this->productAttributeRepository->deleteWhere([
                'product_id' => $request->get('product_id'),
            ]);
            $this->productSkuRepository->deleteWhere([
                'product_id' => $request->get('product_id'),
            ]);
            $this->productSkuAttributeValueRepository->deleteWhere([
                'product_id' => $request->get('product_id'),
            ]);

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}