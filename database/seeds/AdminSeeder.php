<?php

use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menus')->insert([
            'id' => '1',
            'pid'  => '3',
            'title'=> '商品',
            'path' => 'admin/item'
        ]);
        DB::table('admin_menus')->insert([
            'id' => '2',
            'pid'  => '3',
            'title'=> '後台選單',
            'path' => 'admin/admin_menu'
        ]);
        DB::table('admin_menus')->insert([
            'id' => '3',
            'pid'  => null,
            'title'=> '全部功能',
            'path' => 'aaa'
        ]);
    }
}
