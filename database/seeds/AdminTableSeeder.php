<?php

use Encore\Admin\Auth\Database\AdminTablesSeeder;
use Encore\Admin\Auth\Database\Menu;

class AdminTableSeeder extends AdminTablesSeeder
{
    /**
     * Run the database seeds.
     * 讓執行seeder 的時候可以同時建立laravel-admin 的後台相關資料
     *
     * @return void
     */
    public function run(){
        parent::run();
        $this->insertMenu();
    }

    protected function insertMenu(){
        Menu::insert([
            [
                'parent_id' => 0,
                'order'     => 8,
                'title'     => 'Users',
                'icon'      => 'fa-group',
                'uri'       => '/users',
                'permission' => 'auth.management',
                'created_at' => date('Y-m-d h:m:s',time()),
                'updated_at' => date('Y-m-d h:m:s',time())
            ],
            [
                'parent_id' => 0,
                'order'     => 9,
                'title'     => 'Products',
                'icon'      => 'fa-cube',
                'uri'       => '/products',
                'permission' => 'auth.management',
                'created_at' => date('y-m-d h:m:s',time()),
                'updated_at' => date('y-m-d h:m:s',time())
            ],
            [
                'parent_id' => 0,
                'order'     => 10,
                'title'     => 'ProductSkus',
                'icon'      => 'fa-bars',
                'uri'       => '/product-skus',
                'permission' => 'auth.management',
                'created_at' => date('y-m-d h:m:s',time()),
                'updated_at' => date('y-m-d h:m:s',time())
            ]
        ]);
    }
}
