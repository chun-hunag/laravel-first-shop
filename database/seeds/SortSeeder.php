<?php

use Illuminate\Database\Seeder;
use App\Sort;

class SortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sort::insert([
            [   
                'id' => 1,
                'name' => '衣著',
                'created_at' =>  date('Y-m-d h:m:s',time()),
                'updated_at' =>  date('Y-m-d h:m:s',time())
            ],
            [
                'id' => 2,
                'name' => '美妝保健',
                'created_at' =>  date('Y-m-d h:m:s',time()),
                'updated_at' =>  date('Y-m-d h:m:s',time())
            ],
            [
                'id' => 3,
                'name' => '居家生活',
                'created_at' =>  date('Y-m-d h:m:s',time()),
                'updated_at' =>  date('Y-m-d h:m:s',time())
            ],
            [
                'id' => 4,
                'name' => '配件',
                'created_at' =>  date('Y-m-d h:m:s',time()),
                'updated_at' =>  date('Y-m-d h:m:s',time())
            ],
            [
                'id' => 5,
                'name' => '3C',
                'created_at' =>  date('Y-m-d h:m:s',time()),
                'updated_at' =>  date('Y-m-d h:m:s',time())
            ],
        ]);
    }
}
