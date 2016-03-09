<?php
    Class User
    {
        private $username;
        private $password;
        private $email;
        private $id;

        function __construct($username, $password, $email, $id = null)
        {
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->id = $id;
        }

        function setUsername($username)
        {
            $this->username = $username;
        }

        function getUsername()
        {
            return $this->username;
        }

        function setPassword($password)
        {
            $this->password = $password;
        }

        function getPassword()
        {
            return $this->password;
        }

        function setEmail($email)
        {
            $this->email = $email;
        }

        function getEmail()
        {
            return $this->email;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO users (username, password, email) VALUES ('{$this->getUsername()}', '".md5({$this->getPassword()})", {$this->getEmail()});");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_users = $GLOBALS['DB']->query("SELECT * FROM users;");
            $users = array();
            foreach($returned_users as $user) {
                $username = $user['username'];
                $password = $user['password'];
                $email = $user['email'];
                $id = $user['id'];
                $new_user = new User($username, $password, $email, $id);
                array_push($users, $new_user);
            }
            return $users;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM users;");
        }

        function deleteUser()
        {
            $GLOBALS['DB']->exec("DELETE FROM users WHERE id = {$this->getId()};");
        }

         static function findUserById($search_id)
        {
            $found_user = null;
            $users = User::getAll();
            foreach($users as $user) {
                $user_id = $user->getId();
                if ($user_id == $search_id) {
                    $found_user = $user;
                }
            }
            return $found_user;
        }

        function addPokemon($pokemon)
        {
            $GLOBALS['DB']->exec("INSERT INTO pokemon_users (pokemon_id, user_id)  VALUES ({$pokemon->getId()}, {$this->getId()});");
        }

        function getPokemon()
        {
            $returned_pokemon = $GLOBALS['DB']->query("SELECT pokemon.* FROM users
                JOIN pokemon_users ON (users.id = pokemon_users.user_id)
                JOIN pokemon ON (pokemon_users.pokemon_id = pokemon.id)
                WHERE users.id = {$this->getId()};");
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
