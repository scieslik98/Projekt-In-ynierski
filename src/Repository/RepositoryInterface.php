<?php


namespace App\Repository;


interface RepositoryInterface
{
    public function getId($object);
    public function getAll();
    public function findBy($expression);
    public function create();
    public function delete();

}