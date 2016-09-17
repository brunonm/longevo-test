<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PedidoRepository")
 */
class Pedido
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     */
    private $cliente;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;
    
    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="data_inclusao", type="datetime")
     */
    private $dataInclusao;    
    
    /**
     * @param Cliente $cliente
     * @param string $descricao
     */
    public function __construct(Cliente $cliente, $descricao)
    {
        $this->setCliente($cliente);
        $this->setDescricao($descricao);
        $this->dataInclusao = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cliente
     *
     * @param Cliente $cliente
     *
     * @return Pedido
     */
    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Pedido
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }
    
    /**
     * @return \DateTime
     */
    public function getDataInclusao()
    {
        return $this->dataInclusao;
    }  
}

