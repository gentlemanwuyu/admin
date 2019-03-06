<?php
namespace App\Modules\Category\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Category\Database\Seeds\ProductCategoriesTableSeeder;

class CategoryDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		 $this->call(ProductCategoriesTableSeeder::class);
	}

}
