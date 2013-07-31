<?php namespace Pessoa;

use \UnexpectedValueException as Argument;

/**
 * Classe para criação da entidade Pessoa Fisica e Juridica
 * @abstract
 * @author Ramon Barros
 * @package Cliente
 * @category cadastro
 */
abstract class AbstractPessoa implements PessoaInterface {
	protected $doc1;
	protected $doc2;
	protected $nome;
	protected $tipo;

	public function getDoc1(){
		return $this->doc1;
	}

	public function getDoc2(){
		return $this->doc2;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function setDoc1( $doc1=null ){
		if(is_null($doc1)){
			throw new Argument("Você deve informar um documento.");			
		}
		$this->doc1 = $this->onlynumber( $doc1 );
		return $this;
	}

	public function setDoc2( $doc2=null ){
		if(is_null($doc2)){
			throw new Argument("Você deve informar um documento.");			
		}
		$this->doc2 = $this->onlynumber( $doc2 );
		return $this;
	}

	public function setNome( $nome=null ){
		if(is_null($nome)){
			throw new Argument("Você deve informar um nome.");			
		}
		$this->nome = $this->onlynumber( $nome );
		return $this;
	}

	public function onlynumber( $string ){
		return preg_replace('/\D/', '', $string);
	}

}