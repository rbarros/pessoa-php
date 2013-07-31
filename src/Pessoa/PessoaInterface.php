<?php namespace Pessoa;

/**
 * Interface para criação da entidade Pessoa 
 * @abstract
 * @author Ramon Barros
 * @package Pessoa
 * @category cadastro
 */
interface PessoaInterface {

	const FISICA = 1;
	const JURIDICA = 2;

	public function getDoc1();
	public function getDoc2();
	public function getNome();
	public function getTipo();

	public function setDoc1( $doc1=null );
	public function setDoc2( $doc2=null );
	public function setNome( $nome=null );
}