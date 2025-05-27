<?php
namespace Models;

class Unit {
    private ?int $id;
    private string $name;
    private int $cost;
    private string $url_img;

    private array $origins = [];

    public function __construct(array $donnees) {
        $this -> hydrate($donnees);
    }

    public function setOrigins($origins): void {
        if ($origins == null) {
            $this->origins = [];
        }
        else {
            $this->origins = $origins;
        }
    }

    public function getOrigins(): array {
        return $this->origins;
    }



    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getCost() {
        return $this->cost;
    }

    public function getUrlImg():string{
        return $this->url_img;
    }


    public function setId(?string $id): void
    {
        $this->id = $id;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    public function setUrlImg(string $url_img): void {
        $this->url_img = $url_img;
    }


    public function hydrate(array $donnees): void
    {
        $keyMapping = [
            'id' => 'setId',
            'name' => 'setName',
            'cost' => 'setCost',
            'url_img' => 'setUrlImg',
            'origins' => 'setOrigins'
        ];

        foreach ($donnees as $key => $value) {
            if (isset($keyMapping[$key])) {
                $method = $keyMapping[$key];
                $this->$method($value);
            }
        }
    }

}
