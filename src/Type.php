<?php
    Class Type
    {
        private $name;
        private $weakness;
        private $img_path;
        private $id;

        function __construct($name, $weakness, $id = null)
        {
            $this->name = $name;
            $this->weakness = $weakness;
            $this->id = $id;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getName()
        {
            return $this->name;
        }

        function setWeakness($weakness)
        {
            $this->weakness = $weakness;
        }

        function getWeakness()
        {
            return $this->weakness;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO types (name, weakness) VALUES ('{$this->getName()}', '{$this->getWeakness()}');");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_types = $GLOBALS['DB']->query("SELECT * FROM types ORDER BY name;");
            $types = array();
            foreach($returned_types as $type) {
                $name = $type['name'];
                $weakness = $type['weakness'];
                $id = $type['id'];
                $new_type = new Type($name, $weakness, $id);
                array_push($types, $new_type);
            }
            return $types;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM types;");
        }

        function deleteType()
        {
            $GLOBALS['DB']->exec("DELETE FROM types WHERE id = {$this->getId()};");
        }

         static function findTypeById($search_id)
        {
            $found_type = null;
            $types = Type::getAll();
            foreach($types as $type) {
                $type_id = $type->getId();
                if ($type_id == $search_id) {
                    $found_type = $type;
                }
            }
            return $found_type;
        }

        static function findTypeByName($search_name)
        {
            $found_type = null;
            $search_name = ucfirst(strtolower($search_name));
            $types = $GLOBALS['DB']->query("SELECT * FROM types WHERE SOUNDEX(name) = SOUNDEX($search_name);");
            foreach($types as $type) {
                $type_name = $type->getName();
                if ($type_name == $search_name) {
                    $found_type = $type;
                }
            }
            return $found_type;
        }

        function updateTypeName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE types SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function updateTypeWeakness($new_weakness)
        {
            $GLOBALS['DB']->exec("UPDATE types SET weakness = '{$new_weakness}' WHERE id = {$this->getId()};");
            $this->setWeakness($new_weakness);
        }

        function getPokemon()
        {
            $returned_pokemons = $GLOBALS['DB']->query("SELECT pokemons.* FROM pokedex
                JOIN pokemons_types ON (types.id = types_pokemons.type_id)
                JOIN pokemons ON (types_pokemons.pokemon_id = pokemons.id)
                WHERE types.id = {$this->getId()};");
            $pokemons = array() ;
            foreach($returned_pokemons as $pokemon) {
                $name = $pokemon['name'];
                $dex_number = $pokemon['dex_number'];
                $height_feet = $pokemon['height_feet'];
                $height_inches = $pokemon['height_inches'];
                $weight = $pokemon['weight'];
                $id = $pokemon['id'];
                $new_pokemon = new Pokemon($name, $dex_number, $height_feet, $height_inches, $weight, $id);
                array_push($pokemons, $new_pokemon);
            }
            return $pokemons;
        }
    }

?>
