<?php 

    interface ProductInterface {
        public function getAll(): array;
        public function getById(int $id): Produto | string;
        public function insertNew(Produto $newProduct): bool;
        public function delete(int $id):bool;

    }