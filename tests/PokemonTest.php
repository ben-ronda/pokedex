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
            $height_feet = 2;
            $height_inches = 04;
            $weight = "15.2 lbs";
            $test_pokemon = new Pokemon($name, $number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getName();

            $this->assertEquals($name, $result);
        }

        function test_getNumber(){
            $name = "Bulbasaur";
            $number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = "15.2 lbs";
            $test_pokemon = new Pokemon($name, $number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getNumber();

            $this->assertEquals($number, $result);
        }

        function test_getHeightFeet(){
            $name = "Bulbasaur";
            $number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = "15.2 lbs";
            $test_pokemon = new Pokemon($name, $number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getHeightFeet();

            $this->assertEquals($height_feet, $result);
        }

        function test_getHeightInches(){
            $name = "Bulbasaur";
            $number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = "15.2 lbs";
            $test_pokemon = new Pokemon($name, $number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getHeightInches();

            $this->assertEquals($height_inches, $result);
        }

        function test_getWeight() {
            $name = "Bulbasaur";
            $number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = "15.2 lbs";
            $test_pokemon = new Pokemon($name, $number, $height_feet, $height_inches, $weight);

            $result = $test_pokemon->getWeight();

            $this->assertEquals($weight, $result);
        }


    }
?>
