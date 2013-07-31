<?php namespace Pessoa;

/**
 * Pessoa
 *
 * @package		Pessoa
 * @category    cadastro
 * @author		Ramon Barros
 * @copyright	Copyright (c) 2012, Ramon Barros.
 * @license		http://www.ramon-barros.com/
 * @link		http://public.ramon-barros.com/
 * @since		Version 1.0
 * @filesource  Pessoa.php
 */

use Pessoa\Fisica;
use Pessoa\Juridica;
use Illuminate\Container\Container;
use \Exception;

/**
 * Classe para retornar os dados da entidade Pessoa Fisica ou Juridica
 * @abstract
 * @author Ramon Barros
 * @package Pessoa
 * @category cadastro
 */
class Pessoa extends Container {
	
	protected $error;
	protected $tipo;

	public function __construct($doc=null){
		try{
			if(is_null($doc)){
				throw new Exception("Voc&ecirc; deve informar o documento (CNPJ/CPF).");
			}

			/**
			 * Retorna somente numeros
			 * @var integer
			 */
			$doc = preg_replace('/\D/', '', $doc);

			/**
			 * Verifica se o documento é um CPF
			 */
			if(strlen($doc)==11){
				/**
				 * Insere o tipo de pessoa na classe Pessoa.
				 */
				$this->instance('fisica',new Fisica);

				/**
				 * Insere o documento CPF
				 * @var mixed se o retorno for uma instancia de Pessoa Fisica continua
				 * caso contrário mostra o erro.
				 */
				$this['fisica']->setCpf($doc);
				$this->tipo = $this['fisica']->getTipo();
			}elseif(strlen($doc)==14){
				/**
				 * Insere o tipo de pessoa na classe Pessoa.
				 */
				$this->instance('juridica',new Juridica);

				/**
				 * Insere o documento CNPJ
				 * @var mixed se o retorno for uma instancia de Pessoa Juridica continua
				 * caso contrário mostra o erro.
				 */
				$this['juridica']->setCnpj($doc);
				$this->tipo = $this['juridica']->getTipo();	
			}else{
				throw new Exception('Documento n&acirc;o identificado.');
			}

			$this->error = new \stdClass;
			$this->error->status = false;
			$this->error->msg = '';
		}catch(Exception $e){
			$this->error = new \stdClass;
			$this->error->status = true;
			$this->error->msg = $e->getMessage();
		}
	}

	public function getError(){
		return $this->error;
	}

	public function __call($method, $parameters)
    {
    	if($this->tipo==1){
    		return call_user_func_array(array($this['fisica'], $method), $parameters);
    	}
    	if($this->tipo==2){
    		return call_user_func_array(array($this['juridica'], $method), $parameters);
    	}    	
    }

	/**
	 * Dynamically access application services.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function __get($key)
	{
		return $this[$key];
	}

	/**
	 * Dynamically set application services.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function __set($key, $value)
	{
		$this[$key] = $value;
	}
}