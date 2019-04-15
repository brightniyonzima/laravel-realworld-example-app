<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FormTest extends TestCase
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
    /*
    **run a test on a form 
    */
    public function testArticlesFormTest()
    {
        /*$reponse = $this->visit('/articles/create')
         ->type('title', 'testTitle')
         ->select('category_id', '')
         ->press('submit')
         ->seePageIs('/articles');

        $response->assertStatus(200);*/
    }
}
