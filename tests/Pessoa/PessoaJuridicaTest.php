<?php

use Pessoa\AbstractTest;

/**
* Teste da entidade Pessoa\Juridica
*
* @category Tests
*
*/

class TestPessoaJuridica extends AbstractTest
{

  private $instance;

  public function assertPreConditions()
  {	
      $this->assertTrue(
              class_exists($class = '\Pessoa\Juridica'),
              'Class not found: '.$class
      );
      $this->instance = new \Pessoa\Juridica();
  }

  public function testInstantiationWithoutArgumentsShouldWork(){
    $this->assertInstanceOf('\Pessoa\Juridica', $this->instance);
  }

  /**
   * @depends testInstantiationWithoutArgumentsShouldWork
   */
  /*
  public function testShouldExistsSetterForCpf(){
    $cpf = '12345678900';
    $return = $this->instance->setCpf( $cpf );
    $this->assertEquals($this->instance, $return, 'Returned value should be the same instance for fluent interface');
    $this->assertAttributeEquals($cpf, 'doc1', $this->instance, 'Attribute was not correctly set');
  }
  */
}