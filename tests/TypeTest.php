<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Type.php";
    require_once "src/Pokemon.php";


    $server = 'mysql:host=localhost;dbname=pokedex_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class TypeTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Type::deleteAll();
            Pokemon::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $name = "Fire";
            $weakness = "Water";
            $strength = "Grass";
            $id = null;
            $test_type = new Type($name, $weakness, $strength, $id);
            $test_type->save();

            //Act
            $result = Type::getAll();

            //Assert
            $this->assertEquals($test_type, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Fire";
            $weakness = "Water";
            $strength = "Grass";
            $id = null;

            $name2 = "Ground";
            $weakness2 = "Water";
            $strength2 = "Fire";
            $id2 = null;

            $test_type = new Type($name, $weakness, $strength, $id);
            $test_type->save();
            $test_type2 = new Type($name2, $weakness2, $strength2, $id);
            $test_type2->save();

            //Act
            $result = Type::getAll();

            //Assert
            $this->assertEquals([$test_type, $test_type2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Fire";
            $weakness = "Water";
            $strength = "Grass";
            $id = null;

            $name2 = "Ground";
            $weakness2 = "Water";
            $strength2 = "Fire";
            $id2 = null;

            $test_type = new Type($name, $weakness, $strength, $id);
            $test_type->save();
            $test_type2 = new Type($name2, $weakness2, $strength2, $id);
            $test_type2->save();

            //Act
            Type::deleteAll();

            //Assert
            $result = Type::getAll();
            $this->assertEquals([], $result);
        }

        function testDeleteType()
        {
            //Arrange
            $name = "Fire";
            $weakness = "Water";
            $strength = "Grass";
            $id = null;

            $name2 = "Ground";
            $weakness2 = "Water";
            $strength2 = "Fire";
            $id2 = null;

            $test_type = new Type($name, $weakness, $strength, $id);
            $test_type->save();
            $test_type2 = new Type($name2, $weakness2, $strength2, $id);
            $test_type2->save();

            //Act
            $test_type->deleteType();

            //Assert
            $this->assertEquals([$test_type2], Type::getAll());
        }

        function testFindTypeById()
        {
            //Arrange
            $name = "Fire";
            $weakness = "Water";
            $strength = "Grass";
            $id = null;

            $name2 = "Ground";
            $weakness2 = "Water";
            $strength2 = "Fire";
            $id2 = null;

            $test_type = new Type($name, $weakness, $strength, $id);
            $test_type->save();
            $test_type2 = new Type($name2, $weakness2, $strength2, $id);
            $test_type2->save();

            //Act
            $result = Type::findTypeById($test_type->getId());

            //Assert
            $this->assertEquals($test_type, $result);
        }

        function testFindTypeByName()
        {
            //Arrange
            $name = "Fire";
            $weakness = "Water";
            $strength = "Grass";
            $id = null;

            $name2 = "Ground";
            $weakness2 = "Water";
            $strength2 = "Fire";
            $id2 = null;

            $test_type = new Type($name, $weakness, $strength, $id);
            $test_type->save();
            $test_type2 = new Type($name2, $weakness2, $strength2, $id);
            $test_type2->save();
            //Act
            $result = Type::findTypeByName("fIrE");

            //Assert
            $this->assertEquals($test_type, $result);
        }

        // function testFindTypeByPartial()
        // {
        //     //Arrange
        //     $name = "Fire";
        //     $weakness = "Water";
        //     $strength = "Grass";
        //     $id = null;
        //
        //     $name2 = "Ground";
        //     $weakness2 = "Water";
        //     $strength2 = "Fire";
        //     $id2 = null;
        //
        //     $test_type = new Type($name, $weakness, $strength, $id);
        //     $test_type->save();
        //     $test_type2 = new Type($name2, $weakness2, $strength2, $id);
        //     $test_type2->save();
        //
        //     //Act
        //     $result = Type::findTypeByName("frie");
        //
        //
        //     //Assert
        //     $this->assertEquals($test_type, $result);
        // }

          function testGetPokemon()
          {
              //Arrange
              $name = "Fire";
              $weakness = "Water";
              $strength = "Grass";
              $id = null;
              $test_type = new Type($name, $weakness, $strength, $id);
              $test_type->save();

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

              //Act
              $test_type->addPokemon($test_pokemon);
              $test_type->addPokemon($test_pokemon2);
              $result = $test_type->getPokemon();

              //Assert
              $this->assertEquals([$test_pokemon, $test_pokemon2], $result);
          }

          function testGetPokemonByTypes()
          {
              //Arrange
              $name = "Fire";
              $weakness = "Water";
              $strength = "Grass";
              $id = null;
              $test_type = new Type($name, $weakness, $strength, $id);
              $test_type->save();

              $name2 = "Ground";
              $weakness2 = "Water";
              $strength2 = "Fire";
              $id2 = null;
              $test_type2 = new Type($name2, $weakness2, $strength2, $id);
              $test_type2->save();

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


              //Act
              $test_type->addPokemon($test_pokemon);
              $test_type2->addPokemon($test_pokemon);
              $test_type->addPokemon($test_pokemon2);
              $result = $test_type->getPokemonByTypes($test_type, $test_type2);


              //Assert
              $this->assertEquals([$test_pokemon], $result);
          }




    }

?>
