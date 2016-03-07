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
            $weakness = "Water"
            $id = null;
            $test_type = new Type($name, $weakness, $id);
            $test_type->save();

            //Act
            $result = Type::getAll();

            //Assert
            $this->assertEquals($test_type, $result[0]);
        }

        // function testGetAll()
        // {
        //     //Arrange
        //     $name = "John Clancy";
        //     $id = 2;
        //
        //     $name2 = "Robert Ludlum";
        //     $id2 = 3;
        //
        //     $test_type = new Type($name, $id);
        //     $test_type->save();
        //     $test_type2 = new Type($name2, $id2);
        //     $test_type2->save();
        //
        //     //Act
        //     $result = Type::getAll();
        //
        //     //Assert
        //     $this->assertEquals([$test_type, $test_type2], $result);
        // }
        //
        // function testDeleteAll()
        // {
        //     //Arrange
        //     $name = "John Clancy";
        //     $id = 2;
        //
        //     $name2 = "Robert Ludlum";
        //     $id2 = 3;
        //
        //     $test_type = new Type($name, $id);
        //     $test_type->save();
        //     $test_type2 = new Type($name2, $id2);
        //     $test_type2->save();
        //
        //     //Act
        //     Type::deleteAll();
        //
        //     //Assert
        //     $result = Type::getAll();
        //     $this->assertEquals([], $result);
        // }
        //
        // function testUpdateType()
        // {
        //     //Arrange
        //     $name = "John Clancy";
        //     $id = 2;
        //
        //     $test_type = new Type($name, $id);
        //     $test_type->save();
        //     $new_name = "Jon Clancy";
        //
        //     //Act
        //     $test_type->updateType($new_name);
        //
        //     //Assert
        //     $this->assertEquals("Jon Clancy", $test_type->getName());
        // }
        //
        // function testDeleteType()
        // {
        //     //Arrange
        //     $name = "John Clancy";
        //     $id = 2;
        //
        //     $name2 = "Robert Ludlum";
        //     $id2 = 3;
        //
        //     $test_type = new Type($name, $id);
        //     $test_type->save();
        //     $test_type2 = new Type($name2, $id2);
        //     $test_type2->save();
        //
        //     //Act
        //     $test_type->deleteType();
        //
        //     //Assert
        //     $this->assertEquals([$test_type2], Type::getAll());
        // }
        //
        // function testFindType()
        // {
        //     //Arrange
        //     $name = "John Clancy";
        //     $id = 2;
        //
        //     $name2 = "Robert Ludlum";
        //     $id2 = 3;
        //
        //     $test_type = new Type($name, $id);
        //     $test_type->save();
        //     $test_type2 = new Type($name2, $id2);
        //     $test_type2->save();
        //
        //     //Act
        //     $result = Type::findType($test_type->getId());
        //
        //     //Assert
        //     $this->assertEquals($test_type, $result);
        // }

    }

?>
