<?php
    Class Type
    {
        private $name;
        private $weakness;
        private $strength;
        private $id;

        function __construct($name, $weakness, $strength, $id = null)
        {
            $this->name = $name;
            $this->weakness = $weakness;
            $this->strength = $strength;
            $this->id = $id;
        }

        // function setName($name)
        // {
        //     $this->name = $name;
        // }

        function getName()
        {
            return $this->name;
        }

        // function setWeakness($weakness)
        // {
        //     $this->weakness = $weakness;
        // }

        function getWeakness()
        {
            return $this->weakness;
        }

        function getStrength()
        {
            return $this->strength;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO types (name, weakness, strength) VALUES ('{$this->getName()}', '{$this->getWeakness()}', '{$this->getStrength()}');");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_types = $GLOBALS['DB']->query("SELECT * FROM types ORDER BY name;");
            $types = array();
            foreach($returned_types as $type) {
                $name = $type['name'];
                $weakness = $type['weakness'];
                $strength = $type['strength'];
                $id = $type['id'];
                $new_type = new Type($name, $weakness, $strength, $id);
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
            $types = Type::getAll();
            foreach($types as $type) {
            $type_name = $type->getName();
                if ($type_name == $search_name) {
                $found_type = $type;
                }
            }
            return $found_type;
        }

        function addPokemon($pokemon)
        {
            $GLOBALS['DB']->exec("INSERT INTO pokemon_types (type_id, pokemon_id)  VALUES ({$this->getId()}, {$pokemon->getId()});");
        }

        function getPokemon()
        {
            $returned_pokemon = $GLOBALS['DB']->query("SELECT pokemon.* FROM types
                JOIN pokemon_types ON (types.id = pokemon_types.type_id)
                JOIN pokemon ON (pokemon_types.pokemon_id = pokemon.id)
                WHERE types.id = {$this->getId()};");
            $pokemons = array();
            foreach($returned_pokemon as $pokemon) {
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
