<?php
    class Pokemon{
        private $name;
        private $dex_number;
        private $height_feet;
        private $height_inches;
        private $weight;
        private $id;
        private $img;
        private $description;

        function __construct($name, $dex_number, $height_feet, $height_inches, $weight, $img, $description, $parent_id, $id = null){
            $this->name = $name;
            $this->dex_number = $dex_number;
            $this->height_feet = $height_feet;
            $this->height_inches = $height_inches;
            $this->weight = $weight;
            $this->img = $img;
            $this->description = $description;
            $this->id = $id;
            $this->parent_id = $parent_id;
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

        function getDescription(){
            return $this->description;
        }

        function getParentId(){
            return $this->parent_id;
        }

        function getParentPokemon(){
            return Pokemon::findPokemon($this->parent_id);
        }

        function getTypes(){
            $returned_types = $GLOBALS['DB']->query("SELECT types.* FROM pokemon
                JOIN pokemon_types ON (pokemon.id = pokemon_types.pokemon_id)
                JOIN types ON (pokemon_types.type_id = types.id)
                WHERE pokemon.id = {$this->getId()};");

            $types = array();
            foreach($returned_types as $type){
                $name = $type['name'];
                $weakness = $type['weakness'];
                $strength = $type['strength'];
                $img_path = $type['img_path'];
                $id = $type['id'];
                $new_type = new Type($name, $weakness, $strength, $img_path, $id);
                array_push($types, $new_type);
            }
            return $types;
        }

        function addTypes($type)
        {
            $GLOBALS['DB']->exec("INSERT INTO pokemon_types (type_id, pokemon_id)  VALUES ({$type->getId()}, {$this->getId()});");
        }

        function save(){
            $GLOBALS['DB']->exec("INSERT INTO pokemon (name, height_feet, height_inches, weight, dex_number, description)
            VALUES ('{$this->getName()}', {$this->getHeightFeet()}, {$this->getHeightInches()}, {$this->getWeight()}, '{$this->getDexNumber()}', '{$this->getImagePath()}', '{$this->getDescription()}');");
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
                $description = $pokemon['description'];
                $id = $pokemon['id'];
                $parent_id = $pokemon['parent_id'];
                $new_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img, $description, $parent_id, $id);

                array_push($matches, $new_pokemon);
            }
            return $matches;
        }

        static function getAll(){
            $returned_pokemon = $GLOBALS['DB']->query("SELECT * FROM pokemon ORDER BY dex_number;");
            $all = array();
            foreach($returned_pokemon as $pokemon){
                $name = $pokemon['name'];
                $dex_number = $pokemon['dex_number'];
                $height_feet = $pokemon['height_feet'];
                $height_inches = $pokemon['height_inches'];
                $weight = $pokemon['weight'];
                $img = $pokemon['img'];
                $description = $pokemon['description'];
                $id = $pokemon['id'];
                $parent_id = $pokemon['parent_id'];
                $new_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img, $description, $parent_id, $id);

                array_push($all, $new_pokemon);
            }
            return $all;
        }

        static function getAllBut($ids){
            $imploded_ids = implode($ids, ",");
            $returned_pokemon = $GLOBALS['DB']->query("SELECT * FROM pokemon WHERE pokemon.id NOT IN ({$imploded_ids}) ORDER BY dex_number;");
            $all = array();
            foreach($returned_pokemon as $pokemon){
                $name = $pokemon['name'];
                $dex_number = $pokemon['dex_number'];
                $height_feet = $pokemon['height_feet'];
                $height_inches = $pokemon['height_inches'];
                $weight = $pokemon['weight'];
                $img = $pokemon['img'];
                $description = $pokemon['description'];
                $id = $pokemon['id'];
                $parent_id = $pokemon['parent_id'];
                $new_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $img, $description, $parent_id, $id);

                array_push($all, $new_pokemon);
            }
            return $all;
        }

        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM pokemon;");
        }

        static function findPokemon($search_id)
       {
           $found_pokemon = null;
           $pokemons = Pokemon::getAll();
           foreach($pokemons as $pokemon) {
               $pokemon_id = $pokemon->getId();
               if ($pokemon_id == $search_id) {
                   $found_pokemon = $pokemon;
               }
           }
           return $found_pokemon;
       }
    }
?>
