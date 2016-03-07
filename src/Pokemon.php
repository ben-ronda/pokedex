<?php
    class Pokemon{
        private $name;
        private $number;
        private $height_feet;
        private $height_inches;
        private $weight;
        private $id;

        function __construct($name, $number, $height_feet, $height_inches, $weight, $id = null){
            $this->name = $name;
            $this->number = $number;
            $this->height_feet = $height_feet;
            $this->height_inches = $height_inches;
            $this->weight = $weight;
            $this->id = $id;
        }

        function getName(){
            return $this->name;
        }

        function getNumber(){
            return $this->number;
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
    }
?>
