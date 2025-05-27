<?php
namespace Models;
class Origin {
    private int $id;
    private string $name;
    private string $url_img;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->url_img = $data['url_img'] ?? '';
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }
    public function getUrlImg(): string {
        return $this->url_img;
    }
}

