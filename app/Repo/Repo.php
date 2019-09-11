<?php


namespace App\Repo;


interface Repo
{
    function saveUpdate($arg);

    function selectAll();

    function select(...$arg);

    function findById($arg);

    function delete($arg);

    function softDelete();

    function retrieveDeleted();

}