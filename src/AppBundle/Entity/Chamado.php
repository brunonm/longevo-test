<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chamado
 *
 * @ORM\Table(name="chamado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChamadoRepository")
 */
class Chamado
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
     * @var Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido")
     */
    private $pedido;

    /**
     * @var Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     */
    private $cliente;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text")
     */
    private $observacao;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="data_inclusao", type="datetime")
     */
    private $dataInclusao;    
    
    /**
     * @param Pedido $pedido
     * @param Cliente $cliente
     * @param string $titulo
     * @param string $observacao
     */
    public function __construct(Pedido $pedido, Cliente $cliente, $titulo, $observacao)
    {
        $this->setPedido($pedido);
        $this->setCliente($cliente);
        $this->setTitulo($titulo);
        $this->setObservacao($observacao);
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
     * Set pedido
     *
     * @param Pedido $pedido
     *
     * @return Chamado
     */
    public function setPedido(Pedido $pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido
     *
     * @return Pedido
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Chamado
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     *
     * @return Chamado
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set cliente
     *
     * @param Cliente $cliente
     *
     * @return Chamado
     */
    public function setCliente($cliente)
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
     * @return \DateTime
     */
    public function getDataInclusao()
    {
        return $this->dataInclusao;
    }
}

