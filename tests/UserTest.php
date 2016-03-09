<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/User.php";
    require_once "src/Pokemon.php";
    require_once "src/Type.php";


    $server = 'mysql:host=localhost;dbname=pokedex_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class UserTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            User::deleteAll();
            Pokemon::deleteAll();
            Type::deleteAll();

        }

        function testSave()
        {
            //Arrange
            $username = "bpopson@gmail.com";
            $password = "poke-fish";
            $email = "poke@pokemon.com"
            $id = null;
            $test_user = new User($username, $password, $email, $id);
            $test_user->save();

            //Act
            $result = User::getAll();

            //Assert
            $this->assertEquals($test_user, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $username = "bpopson";
            $password = "poke-fish";
            $email = "poke@pokemon.com"
            $id = null;
            $test_user = new User($username, $password, $email, $id);
            $test_user->save();

            $username2 = "aaike001";
            $password2 = "pokepoke";
            $email2 = "poke2@pokemon.com"
            $id = null;
            $test_user2 = new User($username2, $password2, $email2, $id);
            $test_user2->save();

            //Act
            $result = User::getAll();

            //Assert
            $this->assertEquals([$test_user, $test_user2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $username = "bpopson";
            $password = "poke-fish";
            $email = "poke@pokemon.com"
            $id = null;
            $test_user = new User($username, $password, $email, $id);
            $test_user->save();

            $username2 = "aaike001";
            $password2 = "pokepoke";
            $email2 = "poke2@pokemon.com"
            $id = null;
            $test_user2 = new User($username2, $password2, $email2, $id);
            $test_user2->save();

            //Act
            User::deleteAll();

            //Assert
            $result = User::getAll();
            $this->assertEquals([], $result);
        }

        function testDeleteUser()
        {
            //Arrange
            $username = "bpopson";
            $password = "poke-fish";
            $email = "poke@pokemon.com"
            $id = null;
            $test_user = new User($username, $password, $email, $id);
            $test_user->save();

            $username2 = "aaike001";
            $password2 = "pokepoke";
            $email2 = "poke2@pokemon.com"
            $id = null;
            $test_user2 = new User($username2, $password2, $email2, $id);
            $test_user2->save();

            //Act
            $test_user->deleteUser();

            //Assert
            $this->assertEquals([$test_user2], User::getAll());
        }

        function testFindUserById()
        {
            //Arrange
            $username = "bpopson";
            $password = "poke-fish";
            $email = "poke@pokemon.com"
            $id = null;
            $test_user = new User($username, $password, $email, $id);
            $test_user->save();

            $username2 = "aaike001";
            $password2 = "pokepoke";
            $email2 = "poke2@pokemon.com"
            $id = null;
            $test_user2 = new User($username2, $password2, $email2, $id);
            $test_user2->save();

            //Act
            $result = User::findUserById($test_user->getId());

            //Assert
            $this->assertEquals($test_user, $result);
        }

        function testFindUserByName()
        {
            //Arrange
            $username = "bpopson";
            $password = "poke-fish";
            $email = "poke@pokemon.com"
            $id = null;
            $test_user = new User($username, $password, $email, $id);
            $test_user->save();

            $username2 = "aaike001";
            $password2 = "pokepoke";
            $email2 = "poke2@pokemon.com"
            $id = null;
            $test_user2 = new User($username2, $password2, $email2, $id);
            $test_user2->save();

            //Act
            $result = User::findUserByName($test_user->getName());

            //Assert
            $this->assertEquals($test_user, $result);
        }


          function testGetPokemon()
          {
              //Arrange
              $username = "bpopson";
              $password = "poke-fish";
              $email = "poke@pokemon.com"
              $id = null;
              $test_user = new User($username, $password, $email, $id);
              $test_user->save();

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
              $test_user->addPokemon($test_pokemon);
              $test_user->addPokemon($test_pokemon2);
              $result = $test_user->getPokemon();

              //Assert
              $this->assertEquals([$test_pokemon, $test_pokemon2], $result);
          }

    }

?>
