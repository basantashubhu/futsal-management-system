<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StipendItemTest extends TestCase
{

	use DatabaseMigrations;

   /** @test */
    public function can_view_stipend_item_index()
    {

    	$this->withoutExceptionHandling();

    	$this->signIn();

    	$this->get('stipend/items')
        ->assertStatus(200);
    }
}
