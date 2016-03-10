<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Pokemon.php";
    require_once "src/Type.php";

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
            $description = "Bulb";
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img = null, $description);

            $result = $test_pokemon->getName();

            $this->assertEquals($name, $result);
        }

        function test_getDexNumber(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $description = "Bulb";
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img = null, $description);

            $result = $test_pokemon->getDexNumber();

            $this->assertEquals($dex_number, $result);
        }

        function test_getHeightFeet(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $description = "Bulb";
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img = null, $description);

            $result = $test_pokemon->getHeightFeet();

            $this->assertEquals($height_feet, $result);
        }

        function test_getHeightInches(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $description = "Bulb";
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img = null, $description);

            $result = $test_pokemon->getHeightInches();

            $this->assertEquals($height_inches, $result);
        }

        function test_getWeight() {
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $description = "Bulb";
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img = null, $description);

            $result = $test_pokemon->getWeight();

            $this->assertEquals($weight, $result);
        }

        function test_save(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $description = "Bulb";
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img = null, $description);
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
            $description = "Bulb";
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img = null, $description);
            $test_pokemon->save();

            $name2 = "Charmander";
            $dex_number2 = "004";
            $height_feet2 = 2;
            $height_inches2 = 00;
            $weight2 = 18.7;
            $description2 = "Lizard";
            $test_pokemon2 = new Pokemon($name2, $dex_number2, $height_feet2, $height_inches2, $weight2, $img = null, $description2);
            $test_pokemon2->save();

            $result = Pokemon::getAll();

            $this->assertEquals([$test_pokemon, $test_pokemon2], $result);
        }

        function test_searchName(){
            $name = "Bulbasaur";
            $dex_number = "001";
            $height_feet = 2;
            $height_inches = 04;
            $weight = 15.2;
            $description = "Bulb";
            $test_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img = null, $description);
            $test_pokemon->save();

            $name2 = "Charmander";
            $dex_number2 = "004";
            $height_feet2 = 2;
            $height_inches2 = 00;
            $weight2 = 18.7;
            $description2 = "Lizard";
            $test_pokemon2 = new Pokemon($name2, $dex_number2, $height_feet2, $height_inches2, $weight2, $img = null, $description2);
            $test_pokemon2->save();

            $result = Pokemon::searchName($test_pokemon2->getName());

            $this->assertEquals([$test_pokemon2], $result);
        }

        function test_getTypes(){
            $name2 = "Charmander";
            $dex_number2 = "004";
            $height_feet2 = 2;
            $height_inches2 = 00;
            $weight2 = 18.7;
            $description2 = "Lizard";
            $test_pokemon2 = new Pokemon($name2, $dex_number2, $height_feet2, $height_inches2, $weight2, $img = null, $description2);
            $test_pokemon2->save();

            $name = "Fire";
            $weakness = "Water";
            $strength = "Grass";
            $id = null;
            $test_type = new Type($name, $weakness, $strength, $id);
            $test_type->save();

            $test_pokemon2->addTypes($test_type);

            $result = $test_pokemon2->getTypes();

            // var_dump($result);

            $this->assertEquals([$test_type], $result);
        }
    }
?>
