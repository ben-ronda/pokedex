<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Pokemon.php";

    // $server = 'mysql:host=localhost:8889;dbname=pokedex_test';
    // $username = 'root';
    // $password = 'root';
    // $DB = new PDO($server, $username, $password);

    class PokemonTest extends PHPUnit_Framework_TestCase {

        function test_getName(){
            $name = "Bulbasaur";
            $number = "001";
            $height = "";
            $weight = "15.2 lbs";
            $test_pokemon = new Pokemon($name, $number, $height, $weight);

            $result = $test_pokemon->getName();

            $this->assertEquals($name, $result);
        }
    }
?>
