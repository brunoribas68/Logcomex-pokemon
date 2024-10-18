<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PokemonControllerTest extends TestCase
{

    public function test_should_receive_an_list_of_pokemon(): void
    {
        $response = $this->get('/pokemons');
        dd($response);
        $response->assertStatus(200);
        self::assertTrue($response[0]['name'] === 'bulbasaur');
    }


    public function test_given_an_an_name_get_specific_pokemon()
    {
        $this->withExceptionHandling();

        $pokemonName = "bulbasaur";
        $response = $this->get('/pokemon/'.$pokemonName);

        $response->assertStatus(200);
        self::assertTrue($response[0]['name'] === 'bulbasaur');

    }
}
