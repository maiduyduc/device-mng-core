<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_infos')->insert([
            ['document_id' => 1, 'category_id' => 2,'device_name' => 'Màn hình Dell', 'device_info' => 'Màn 24 inch','origin' => 'VN', 'unit' => 'Bộ', 'order_qty' => 30, 'stock' => 0 , 'recommended_qty' => 30, 'unit_price' => 1200000, 'total_money' => 36000000, 'note' => 'Mua thay thế màn hỏng', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 1, 'category_id' => 1,'device_name' => 'Ghế tựa gấp', 'device_info' => 'Ghế tựa gấp','origin' => 'VN', 'unit' => 'Cái', 'order_qty' => 30, 'stock' => 0 , 'recommended_qty' => 30, 'unit_price' => 100000, 'total_money' => 3000000, 'note' => 'Mua thay thế ghế hỏng', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 1, 'category_id' => 2,'device_name' => 'Hạt mạng RJ45', 'device_info' => 'Hạt mạng RJ45','origin' => 'VN', 'unit' => 'Hộp', 'order_qty' => 2, 'stock' => 0 , 'recommended_qty' => 100, 'unit_price' => 1000, 'total_money' => 100000, 'note' => 'Đi dây mạng phòng thực hành mới', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 1, 'category_id' => 4,'device_name' => 'Giấy A4', 'device_info' => 'Giấy A4','origin' => 'VN', 'unit' => 'Ram', 'order_qty' => 30, 'stock' => 0 , 'recommended_qty' => 30, 'unit_price' => 1200000, 'total_money' => 36000000, 'note' => '', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 1, 'category_id' => 5,'device_name' => 'Kéo cắt giấy', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 2, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 1', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 2, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 2', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 2, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 3', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 3, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 4', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 3, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 5', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 3, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 6', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 3, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 7', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 4, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 8', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 4, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 9', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 5, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 10', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 5, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 11', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 5, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 12', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 5, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 13', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
            ['document_id' => 5, 'category_id' => 5,'device_name' => 'Kéo cắt giấy 14', 'device_info' => '','origin' => '', 'unit' => 'Cái', 'order_qty' => 5, 'stock' => 0 , 'recommended_qty' => 5, 'unit_price' => 20000, 'total_money' => 100000, 'note' => 'Dùng cho ngành đồ họa', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
