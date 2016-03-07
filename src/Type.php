<?php
    Class Type
    {
        private $name;
        private $weakness;
        private $id;

        function __construct($name, $weakness, $id = null)
        {
            $this->name = $name;

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
            $returned_types = $GLOBALS['DB']->query("SELECT * FROM types;");
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

         static function findType($search_id)
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
    }

?>
