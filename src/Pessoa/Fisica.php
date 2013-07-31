<?php namespace Pessoa;

use Pessoa\AbstractPessoa;
use Pessoa\Exceptions\CpfInvalidoException;

/**
 * Classe para criação da entidade Pessoa Fisica
 * @author Ramon Barros
 * @package Pessoa
 * @category cadastro
 */
class Fisica extends AbstractPessoa {

	protected $mask;

	public function __construct(){
		$this->tipo = self::FISICA;
		$this->setMask( false );
	}

	public function setCpf( $cpf=null ){
		try {
			if( $this->validar_cpf( $cpf ) ) {
            	$this->setDoc1( $cpf );
	        } else {
	            throw new CpfInvalidoException();
	        }	
		} catch (CpfInvalidoException $e) {
			return $e->getMessage();
		}
		return $this;
	}

	public function setMask( $mask=false ){
		$this->mask = $mask;
		return $this;
	}

	public function getCpf(){
		$cpf = $this->getDoc1();
		if($this->mask){
			return preg_replace( '/^([\d]{3})([\d]{3})([\d]{3})([\d]{2})$/', '${1}.${2}.${3}-${4}', $cpf);
		}
		return $cpf;
	}

	public function setRg( $rg=null ){
		$this->setDoc2( $rg );
		return $this;
	}

    public function getRg(){
        return $this->getDoc2();
    }


	/**
     * Verifica se é um número de CPF válido.
     * @param $cpf O número a ser verificado
     * @return boolean
     */
    private function validar_cpf( $cpf ) {
        
        $cpf = preg_replace('/\D/', '', $cpf);
        
        if ( strlen( $cpf ) != 11 ) {
            return false;
        }
        
        if( preg_match( '/^(\d{1})\1{10}$/', $cpf ) ) {
            return false;
        }
        
        $sum = 0;
        for( $i = 0; $i < 9; $i++ ) {
            $sum += $cpf[$i] * (10-$i);
        }
        $mod = $sum % 11;
        $digit = ($mod > 1) ? (11 - $mod) : 0;
     
        if ($cpf[9] != $digit) {
            return false;
        }
     
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += $cpf[$i] * (11-$i);
        }
        $mod = $sum % 11;
        $digit = ($mod > 1) ? (11 - $mod) : 0;
     
        if ($cpf[10] != $digit){
            return false;
        }
        return true;
    }
}