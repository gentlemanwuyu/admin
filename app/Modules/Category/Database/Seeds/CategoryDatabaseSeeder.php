<?php
namespace App\Modules\Category\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
		 $this->call(GoodsCategoriesTableSeeder::class);
		$this->call(CategoriesTableSeeder::class);
	}

}
