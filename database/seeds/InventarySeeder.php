<?php

use Illuminate\Database\Seeder;

class InventarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

       for($i=1;$i<10;$i++){
        DB::table('client_type')->insert([
            'code'=> 'CT-00'.$i,
            'title'=>'ClientType Test'.$i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
       DB::table('client')->insert([
            'id'=> $i+23658432,
            'title'=>'Client Test'.$i,
            'client_type' => $i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('employee_type')->insert([
            'code'=> 'ET-00'.$i,
            'title'=>'EmployeeType Test'.$i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
       DB::table('employee')->insert([
            'id'=> $i+21245987,
            'title'=>'EmployeeType Test'.$i,
            'employee_type' => $i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('brand')->insert([
            'code' => 'B-00'.$i,
            'title'=>'Brand Test'.$i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

         DB::table('measure')->insert([
            'code' => 'M-00'.$i,
            'title'=>'Measure Test'.$i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

         DB::table('category')->insert([
            'code' => 'C-00'.$i,
            'title'=>'Category Test'.$i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

         DB::table('product_type')->insert([
            'code' => 'PT-00'.$i,
            'title'=>'productType Test'.$i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
         DB::table('supplier_type')->insert([
            'code' => 'ST-00'.$i,
            'title'=>'SupplierType Test'.$i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
         DB::table('supplier')->insert([
            'id' => $i+345567,
            'code' => 'T-00'.$i,
            'title'=>'Supplier Test'.$i,
            'description' => 'description the supplier #'.$i,
            'image' => "['image1.jpg','image2.jpg','image1.jpg']",
            'supplier_type' => $i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

          DB::table('product')->insert([
            'code' => 'P-00'.$i,
            'title'=>'Product Test'.$i,
            'description' => 'description the product #'.$i,
            'image' => "['image1.jpg','image2.jpg','image1.jpg']",
            'product_type' => $i,
            'price' => $i,
            'brand' => $i,
            'category' => $i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

          DB::table('tax')->insert([
            'code' => 'T-00'.$i,
            'title'=>'Tax Test'.$i,
            'value' => 12,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
          ]);

          DB::table('inventary')->insert([
            'code' => 'I-00'.$i,        
            'product' => $i,
            'quantity' => $i+34,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

           DB::table('operation_type')->insert([
            'code' => 'OT-00'.$i,        
            'title' => 'OperationType Test '.$i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);


            DB::table('operation')->insert([
            'code' => 'O-00'.$i,        
            'title' => 'Operation Test '.$i,
            'total' => 32+$i,
            'tax' => 1,
            'operation_type' => 1,
            'client' => 23658433,
            'employee' => 21245988,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

            for($j = 1; $j<3;$j++){
                DB::table('operation_detail')->insert([
            'operation' => $i,
            'product' => $i,
            'quantity' => 2+$j,
            'price' => $i,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

            }

            

       }

    
       
       }

}
