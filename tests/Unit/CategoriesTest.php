<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /* test posting a new category*/
    public function testCategorySending()
    {
        $response = $this->json('POST', '/api/categories', ['name' => 'TestCategory']);

        $response->assertStatus(200);
    }

    /* test the listing */
    public function testCategoryListing()
    {
        $response = $this->json('GET', '/api/categories');

        $response->assertStatus(200);
    }

    /* test updating a new category*/
    public function testCategoryUpdating()
    {
        $response = $this->json('PUT', '/api/categories/1', ['id' => '1']);

        $response->assertStatus(200);
    }

    /* test deleting a new created category*/
    public function testCategoryDeleting()
    {
        $response = $this->json('delete', '/api/categories/1', ['id' => '1']);

        $response->assertStatus(200);
        //check different status codes
    }
}
