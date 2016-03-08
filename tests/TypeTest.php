<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Type.php";


    $server = 'mysql:host=localhost;dbname=pokedex_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class TypeTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Type::deleteAll();
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

    }

?>
