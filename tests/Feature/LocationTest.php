<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LocationTest extends TestCase
{
   
	use DatabaseMigrations, WithFaker;

	public function setUp() : void{

		parent::setUp();

		$this->withoutExceptionHandling();

	}

	/** @test */
	public function can_view_locations_index(){

		$this->get('view/location')
		->assertStatus(200);

	}

	/** @test */
	public function can_add_single_location(){

		$this->signIn();

		$locations = [

			'zip_code' 	=> 	[$this->faker->postcode],
			'district'	=> 	[$this->faker->word],
			'city'		=> 	[$this->faker->city],
			'state'		=> 	[$this->faker->state],
			'county'	=>	[$this->faker->word]

		];

		$this->post('locations', $locations);

		$this->assertDatabaseHas('zip_codes', ['zip_code'=> $locations['zip_code'], 'county' => $locations['county']]);

	}

	/** @test */
	public function can_add_multiple_locations(){

		$this->signIn();

		$locations = [

			'zip_code' 	=> 	[$this->faker->postcode, $this->faker->postcode],
			'district'	=> 	[$this->faker->word, $this->faker->word],
			'city'		=> 	[$this->faker->city, $this->faker->city],
			'state'		=> 	[$this->faker->state, $this->faker->state],
			'county'	=>	[$this->faker->word, $this->faker->word]

		];

		$this->post('locations', $locations);

		$this->assertDatabaseHas('zip_codes', ['zip_code'=> $locations['zip_code'][0], 'county' => $locations['county'][0]]);
		$this->assertDatabaseHas('zip_codes', ['zip_code'=> $locations['zip_code'][1], 'county' => $locations['county'][1]]);
		

	}


}
