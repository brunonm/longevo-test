<?php

namespace AppBundle\Command;

class RegistrarChamadoCommand
{
    /**
     * @var string
     */
    public $nome;
    
    /**
     * @var integer
     */
    public $pedidoId;
    
    /**
     * @var string
     */
    public $email;
    
    /**
     * @var string
     */
    public $titulo;
    
    /**
     * @var string
     */
    public $observacao;
    
    /**
     * @param string $nome
     * @param integer $pedidoId
     * @param integer $email
     * @param string $titulo
     * @param string $observacao
     */
    public function __construct($nome, $pedidoId, $email, $titulo, $observacao)
    {
        $this->nome = $nome;
        $this->pedidoId = $pedidoId;
        $this->email = $email;
        $this->titulo = $titulo;
        $this->observacao = $observacao;
    }
}
