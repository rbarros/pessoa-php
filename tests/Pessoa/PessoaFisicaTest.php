<?php

use Pessoa\AbstractTest;

/**
* Teste da entidade Pessoa\Fisica
*
* @category Tests
*
*/

class TestPessoaFisica extends AbstractTest
{

  private $instance;

  public function assertPreConditions()
  {	
      $this->assertTrue(
              class_exists($class = '\Pessoa\Fisica'),
              'Class not found: '.$class
      );
      $this->instance = new \Pessoa\Fisica();
  }

  public function testInstantiationWithoutArgumentsShouldWork(){
    $this->assertInstanceOf('\Pessoa\Fisica', $this->instance);
  }

  /**
   * @expectedException UnexpectedValueException
   * @expectedExceptionMessage Você deve informar um documento.
   */
  public function testSetWithInvalidDataShouldThrownAnException()
  {
      $this->instance->setDoc1( null );
      $this->instance->setDoc2( null );
  }

  /**
   * @expectedException UnexpectedValueException
   * @expectedExceptionMessage Você deve informar um nome.
   */
  public function testSetWithInvalidDataNameShouldThrownAnException()
  {
      $this->instance->setNome( null );
  }

  /**
   * @depends testInstantiationWithoutArgumentsShouldWork
   */
  public function testStringToNumber(){
    $string = '(54)1234-6789';
    $comp = $this->instance->onlynumber($string);
    $this->assertEquals( $comp , 5412346789 );
  }

  /**
   * @depends testInstantiationWithoutArgumentsShouldWork
   */
  public function testReturnDoc1(){
    $this->instance->setDoc1('123.456.789-00');
    $this->assertEquals( $this->instance->getDoc1() , 12345678900 );
  }

  /**
   * @depends testInstantiationWithoutArgumentsShouldWork
   */
  public function testReturnDoc2(){
    $this->instance->setDoc2('1234567890');
    $this->assertEquals( $this->instance->getDoc2() , 1234567890 );
  }

  /**
   * @depends testInstantiationWithoutArgumentsShouldWork
   */
  public function testGetTipo(){
    $tipo = $this->instance->getTipo();
    $this->assertEquals( $tipo , 1 );
  }

  /**
   * @depends testInstantiationWithoutArgumentsShouldWork
   */
  public function testShouldExistsSetterForMask(){
    $mask = true;
    $return = $this->instance->setMask( $mask );
    $this->assertEquals($this->instance, $return, 'Returned value should be the same instance for fluent interface');
    $this->assertAttributeEquals($mask, 'mask', $this->instance, 'Attribute was not correctly set');
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