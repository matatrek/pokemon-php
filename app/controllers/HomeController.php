<?php 
namespace Controllers;

use Models\PokemonModel;

class HomeController {

    public static function index($data) : void {
        [$router] = $data;
        $router->render('home');
    }

    public static function list() : void {
        $pokemons = PokemonModel::all()->data;
        require __DIR__ ."/../views/components/card-pokemon.php";
    }

    public static function types() : void {
        $pokemons = PokemonModel::select(['type'])->data;
        $types    = [];
        foreach ($pokemons as $item) {
            if (isset($item['type'])) {
                foreach (json_decode($item['type']) as $value) {
                    $types[] = $value;
                }
            }
        }
        $types = array_unique($types);
        require __DIR__ ."/../views/components/filter-type.php";
    }
}