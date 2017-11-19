<?php

namespace Tests\Feature;

use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * test get all products
     */
    public function testGetProducts()
    {
        $response = $this->get('api/product');

        $response->assertStatus(200)
            ->assertJson(["msg" => "Products get successfully"])
        ;
    }

    /** test show product*/
    public function testShowProduct()
    {
        $response = $this->get('api/product/1');

        $response->assertStatus(200)
            ->assertJson(["msg" => "Product found"])
        ;
    }

    /** test create product*/
    public function testCreateProduct()
    {
        $response = $this->json('POST', 'api/product', [
            'category_id' => '2',
            'vendor_id'=>'2',
            'created_by'=>'7',
            'updated_by'=>'4',
            'title'=>'Iphone 5s',
            'locale'=>'FR',
            'extra_product'=>'',
            'extra_product_tr'=>'',
        ]);

        $response->assertStatus(201)
            ->assertJson(['msg' => 'Product created successfully'])
        ;
    }

    /** test update product*/
    public function testUpdateProduct()
    {
        $response = $this->json('PUT', 'api/product/1', [
            'title'=>'Iphone 7 +',
            'updated_by'=>'7'
        ]);

        $response->assertStatus(200)
            ->assertJson(['msg' => 'Product updated successfully'])
        ;
    }

    /** test delete product*/
    public function testDeleteProduct()
    {
        $response = $this->json('Delete', 'api/product/8');

        $response->assertStatus(200)
            ->assertJson(['msg' => 'Product deleted successfully'])
        ;
    }
}
