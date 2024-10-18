<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function getPokeminList()
    {
        try {
            $pokemonsRequest = Http::get(env('POKEMON_ENDPOINT')."pokemon/");
            $pokemonsRequest = Arr::get($pokemonsRequest->json(), 'results', []);
            $pokemons = [];
            foreach ($pokemonsRequest as $pokemonsResponse) {
                $pokemon = Http::get($pokemonsResponse['url']);
                $pokemons[] = [
                    'name' => $pokemon['name'],
                    'type' => $pokemon['types'],
                    'height' => $pokemon['height'] / 0.1000,
                    'weight' => $pokemon['weight'] / 0.1,
                    'image' => $pokemon['sprites']['front_default']
                ];
            }
            return response(json_encode($pokemons), 200);
        }catch (Exception $e ){
            return response("Erro: Erro ao pegar lista de pokemons", 500);
        }
    }

    public function getPokemonByName($name)
    {
        try {
            $pokemon = Http::get(env('POKEMON_ENDPOINT')."pokemon/".$name);
            $pokemon = [
                'name' => $pokemon['name'],
                'type' => $pokemon['types'],
                'height' => $pokemon['height'] / 0.1000,
                'weight' => $pokemon['weight'] / 0.1,
                'image' => $pokemon['sprites']['front_default']

            ];

            return response(json_encode([$pokemon]), 200);
        }catch (Exception $e ) {
            return response("Erro: Erro ao pegar lista de pokemons", 500);
        }
    }

}
