<?php

namespace Tests\AppBundle\Handler;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Mockery as M;
use AppBundle\Command\RegistrarChamadoCommand;
use AppBundle\Handler\RegistrarChamadoHandler;
use AppBundle\Entity\Chamado;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\Cliente;
use AppBundle\Repository\ClienteRepository;

class RegistrarChamadoHandlerTest extends WebTestCase
{
    public function getEntityManagerMock()
    {
        $emMock = M::mock(\Doctrine\ORM\EntityManager::class);
        $emMock->shouldReceive('persist');
        $emMock->shouldReceive('flush');
        $emMock->shouldReceive('find')->andReturn(M::mock(Pedido::class));
        $emMock->shouldReceive('getRepository')->andReturn(
            M::mock(ClienteRepository::class)->shouldReceive('findOneBy')->andReturn(
                M::mock(Cliente::class)
            )->getMock()
        );
        
        return $emMock;
    }
    
    /**
     * @return RegistrarChamadoCommand
     */
    public function getCommand()
    {
        return new RegistrarChamadoCommand(
            'Fulano', 
            '999', 
            'fluano@longevo.com.br', 
            'Meu pedido não chegou', 
            'Meu pedido não chegou'
        );
    }
    
    public function testDeveRegistrarChamadoComSucesso()
    {
        $command = $this->getCommand();
        
        $emMock = $this->getEntityManagerMock();
        
        $handler = new RegistrarChamadoHandler($emMock);
        $chamado = $handler->handle($command);
        
        $this->assertInstanceOf(Chamado::class, $chamado);
        $this->assertEquals($chamado->getTitulo(), $command->titulo);
    }
    
    public function testDeveCadastrarClienteSeNaoEncontrar()
    {
        $command = $this->getCommand();
        
        $emMock = $this->getEntityManagerMock();
        $repoMock = $emMock->getRepository('AppBundle:Cliente');
        $repoMock->mockery_findExpectation('findOneBy', [])->andReturn(null);
        
        $handler = new RegistrarChamadoHandler($emMock);
        $chamado = $handler->handle($command);
        
        $this->assertInstanceOf(Cliente::class, $chamado->getCliente());
        $this->assertEquals($chamado->getCliente()->getEmail(), $command->email);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNaoDeveRegistrarChamadoComPedidoIncorreto()
    {
        $command = $this->getCommand();
        
        $emMock = $this->getEntityManagerMock();
        $emMock->mockery_findExpectation('find', [])->andReturn(null);
        
        $handler = new RegistrarChamadoHandler($emMock);
        $handler->handle($command);
    }
}