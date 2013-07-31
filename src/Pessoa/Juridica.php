<?php namespace Pessoa;

use Pessoa\AbstractPessoa;
use Pessoa\Exceptions\CpfInvalidoException;

/**
 * Classe para criação da entidade Pessoa Juridica
 * @author Ramon Barros
 * @package Pessoa
 * @category cadastro
 */
class Juridica extends AbstractPessoa {

	protected $mask;

	public function __construct(){
		$this->tipo = self::JURIDICA;
		$this->setMask( false );
	}

	public function setCnpj( $cnpj=null ){
		try {
			if( $this->validar_cnpj( $cnpj ) ) {
            	$this->setDoc1( $cnpj );
	        } else {
	            throw new CnpjInvalidoException();
	        }	
		} catch (CnpjInvalidoException $e) {
			return $e->getMessage();
		}
		return $this;
	}

	public function setMask( $mask=false ){
		$this->mask = $mask;
		return $this;
	}

	public function getCnpj(){
		$cnpj = $this->getDoc1();
		if($this->mask){
			return preg_replace( '/^([\d]{2})([\d]{3})([\d]{3})([\d]{4})([\d]{2})$/', '${1}.${2}.${3}/${4}-${5}', $cnpj);
		}
		return $cnpj;
	}

	public function setIe( $ie=null ){
		$this->setDoc2( $ie );
		return $this;
	}

	public function getIe(){
		return $this->getDoc2();
	}

	/**
     * Verifica se é um número de CNPJ válido.
     * @param $cnpj O número a ser verificado
     * @return boolean
     */
	public function validar_cnpj( $cnpj ) {
        
        $cnpj = preg_replace( '/\D/', '', $cnpj );
        
        if ( strlen( $cnpj ) != 14 ) {
            return false;
        }
        
        if( preg_match( '/^(\d{1})\1{13}$/', $cnpj ) ) {
            return false;
        }
        
        $soma = 0;
        for( $i = 0; $i < 12; $i++ ) {
            
            /** verifica qual é o multiplicador. Caso o valor do caracter seja entre 0-3, diminui o valor do caracter por 5
             * caso for entre 4-11, diminui por 13 **/
            $multiplicador = ( $i <= 3 ? 5 : 13 ) - $i;
            
            $soma += $cnpj{$i} * $multiplicador; 
        } 
        $soma = $soma % 11;
        
        
        if ( $soma == 0 || $soma == 1 ) {
            $digitoUm=0;
        } else { 
            $digitoUm = 11 - $soma;
        }
        
        if ( (int)$digitoUm == (int)$cnpj{12} ) {
            
            $soma = 0;
            
            for( $i = 0; $i < 13; $i++ ) {           
            
                /** verifica qual é o multiplicador. Caso o valor do caracter seja entre 0-4, diminui o valor do caracter por 6
                 * caso for entre 4-12, diminui por 14 **/
                $multiplicador = ( $i <= 4 ? 6 : 14 ) - $i;
                $soma += $cnpj{$i} * $multiplicador; 
            }
            $soma = $soma % 11;
            if ( $soma == 0 || $soma == 1) {
                $digitoDois=0;
            } else {
                $digitoDois = 11 - $soma;
            }
            if ( $digitoDois == $cnpj{13}) {
                return true;
            }
        }
        return false;
    }
}