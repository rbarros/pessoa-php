<?php

require __DIR__.'/../tests/bootstrap.php';

echo "<pre>";

$pessoa = new Pessoa\Pessoa();

var_dump($pessoa);

var_dump($pessoa->getError());

$pessoa = new Pessoa\Pessoa('35913314816');

var_dump($pessoa->fisica->getCpf());

var_dump($pessoa->fisica->setMask(true)->getCpf());


$pessoa = new Pessoa\Pessoa('89.373.074/0001-87');

var_dump($pessoa->juridica->getCnpj());

var_dump($pessoa->juridica->setMask(true)->getCnpj());


echo "</pre>";