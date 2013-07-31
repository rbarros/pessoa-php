<?php namespace Pessoa\Exceptions;

use \Exception;

class CpfInvalidoException extends Exception {
    public function __construct() {
        parent::__construct('CPF inv&aacute;lido.');
    }
}