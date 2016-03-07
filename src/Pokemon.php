<?php
    class Pokemon{
        private $name;
        private $number;
        private $height;
        private $weight;
        private $id;

        function __construct($name, $number, $height, $weight, $id = null){
            $this->name = $name;
            $this->number = $number;
            $this->height = $height;
            $this->weight = $weight;
            $this->id = $id;
        }

        function getName(){
            return $this->name;
        }

        function getNumber(){
            return $this->number;
        }

        function getHeight(){
            return $this->height;
        }

        function getWeight(){
            return $this->getWeight;
        }

        function getId(){
            return $this->id;
        }

    }
?>
