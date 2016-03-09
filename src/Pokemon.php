<?php
    class Pokemon{
        private $name;
        private $dex_number;
        private $height_feet;
        private $height_inches;
        private $weight;
        private $id;
        private $img;

        function __construct($name, $dex_number, $height_feet, $height_inches, $weight, $img, $id = null){
            $this->name = $name;
            $this->dex_number = $dex_number;
            $this->height_feet = $height_feet;
            $this->height_inches = $height_inches;
            $this->weight = $weight;
            $this->img = $img;
            $this->id = $id;
        }

        function getName(){
            return $this->name;
        }

        function getDexNumber(){
            return $this->dex_number;
        }

        function getHeightFeet(){
            return $this->height_feet;
        }

        function getHeightInches(){
            return $this->height_inches;
        }

        function getWeight(){
            return $this->weight;
        }

        function getId(){
            return $this->id;
        }

        function getImagePath(){
            return $this->img;
        }


        function save(){
            $GLOBALS['DB']->exec("INSERT INTO pokemon (name, height_feet, height_inches, weight, dex_number)
            VALUES ('{$this->getName()}', {$this->getHeightFeet()}, {$this->getHeightInches()}, {$this->getWeight()}, '{$this->getDexNumber()}', '{$this->getImagePath}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function searchName($search_name){
            $matches = array();
            $returned_pokemon = $GLOBALS['DB']->query("SELECT * FROM pokemon WHERE LOWER(pokemon.name) LIKE LOWER('%{$search_name}%');");
            foreach($returned_pokemon as $pokemon){
                $name = $pokemon['name'];
                $dex_number = $pokemon['dex_number'];
                $height_feet = $pokemon['height_feet'];
                $height_inches = $pokemon['height_inches'];
                $weight = $pokemon['weight'];
                $img = $pokemon['img'];
                $id = $pokemon['id'];
                $new_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img, $id);

                array_push($matches, $new_pokemon);
            }
            return $matches;
        }

        static function getAll(){
            $returned_pokemon = $GLOBALS['DB']->query("SELECT * FROM pokemon;");
            $all = array();
            foreach($returned_pokemon as $pokemon){
                $name = $pokemon['name'];
                $dex_number = $pokemon['dex_number'];
                $height_feet = $pokemon['height_feet'];
                $height_inches = $pokemon['height_inches'];
                $weight = $pokemon['weight'];
                $img = $pokemon['img'];
                $id = $pokemon['id'];
                $new_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img, $id);

                array_push($all, $new_pokemon);
            }
            return $all;
        }

        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM pokemon;");
        }
    }
?>
