<?php namespace Pessoa\Exceptions;

use \Exception;

class CnpjInvalidoException extends Exception {
    public function __construct() {
        parent::__construct('CNPJ inv&aacute;lido.');
    }
}
