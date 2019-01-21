<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [   'id' => 1,
                'name' => 'Phụ kiện dàn máy',
                'name_url' => 'phu-kien-dan-may',
                'parent_id' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   'id' => 2,
                'name' => 'Phụ kiện dàn chân',
                'name_url' => 'phu-kien-dan-chan',
                'parent_id' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   'id' => 3,
                'name' => 'Phụ kiện dàn đầu',
                'name_url' => 'phu-kien-dan-dau',
                'parent_id' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   'id' => 4,
                'name' => 'Sản phẩm GIVI',
                'name_url' => 'san-pham-givi',
                'parent_id' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('categories')->delete();
        DB::table('categories')->insert($categories);
    }
}
