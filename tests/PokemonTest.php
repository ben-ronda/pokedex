<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Pokemon.php";

    $server = 'mysql:host=localhost;dbname=pokedex_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PokemonTest extends PHPUnit_Framework_TestCase {

        protected function tearDown(){
            Pokemon::deleteAll();
        }

        function test_getName(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getName();

            $this->assertEquals($name, $result);
        }

        function test_getDexNumber(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getDexNumber();

            $this->assertEquals($dex_number, $result);
        }

        function test_getHeightFeet(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getHeightFeet();

            $this->assertEquals($height_feet, $result);
        }

        function test_getHeightInches(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getHeightInches();

            $this->assertEquals($height_inches, $result);
        }

        function test_getWeight() {
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getWeight();

            $this->assertEquals($weight, $result);
        }

        function test_save(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight);
            $test_pokemon->save();

            $result = Pokemon::getAll();

            $this->assertEquals([$test_pokemon], $result);
        }

        function test_getAll(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight);
            $test_pokemon->save();

            $name2 = "Charmander";
            $dex_number2 = "004";
            $height_feet2 = 2;
            $height_inches2 = 00;
            $weight2 = 18.7;
            $test_pokemon2 = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight);
            $test_pokemon2->save();

            $result = Pokemon::getAll();

            $this->assertEquals([$test_pokemon, $test_pokemon2], $result);
        }

    }
?>
