<?php

use Pessoa\AbstractTest;

/**
* Teste da entidade Pessoa
*
* @category Tests
*
*/

class TestPessoa extends AbstractTest
{

  public function assertPreConditions()
  {	
      $this->assertTrue(
              class_exists($class = '\Pessoa\Pessoa'),
              'Class not found: '.$class
      );
  }

  /**
   * expectedException Exception
   * expectedExceptionMessage Voc&ecirc; deve informar o documento (CNPJ/CPF).
   */
  public function testSetWithInvalidDataShouldThrownAnException()
  {
      $instance = new \Pessoa\Pessoa();
  }

  public function testInstantiationWithArgumentsShouldWork(){
    $cnpj = '87.408.852/0001-09';
    $instance = new \Pessoa\Pessoa($cnpj);
    $return = $instance['juridica'];
    $juridica = new \Pessoa\Juridica;
    $juridica->setCnpj($cnpj);
    $this->assertEquals($juridica, $return, 'Returned value should be the same instance for fluent interface');
    $this->assertAttributeEquals($return->getCnpj(), 'doc1', $return, 'Attribute was not correctly set');
  }

}