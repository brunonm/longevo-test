<?php

namespace AppBundle\Handler;

use AppBundle\Command\RegistrarChamadoCommand;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Chamado;

class RegistrarChamadoHandler
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    
    /**
     * @param EntityManager $em
     */
    public function __construct($em)
    {
        $this->em = $em;
    }
    
    /**
     * @param RegistrarChamadoHandler $command
     * @return Chamado
     */
    public function handle(RegistrarChamadoCommand $command)
    {
        $pedido = $this->em->find('AppBundle:Pedido', $command->pedidoId);
        
        if (empty($pedido)) {
            throw new \InvalidArgumentException('Pedido não encontrado');
        }
        
        $cliente = $this->em->getRepository('AppBundle:Cliente')->findOneBy([
            'email' => $command->email
        ]);
        
        if (empty($cliente)) {
            $cliente = new Cliente($command->nome, $command->email);
            $this->em->persist($cliente);
        }
        
        $chamado = new Chamado($pedido, $cliente, $command->titulo, $command->observacao);
        
        $this->em->persist($chamado);
        $this->em->flush();
        
        return $chamado;
    }
}
