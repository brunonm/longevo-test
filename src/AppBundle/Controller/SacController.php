<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Command\RegistrarChamadoCommand;

class SacController extends Controller
{
    /**
     * @Route("/sac", name="sac_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('sac/index.html.twig');
    }
    
    /**
     * @Route("/sac/registrar", name="sac_registrar")
     */
    public function registrarAction(Request $request)
    {
        try {
            $command = new RegistrarChamadoCommand(
                $request->request->getAlnum('nome'), 
                $request->request->getInt('pedidoId'), 
                $request->request->get('email'), 
                $request->request->get('titulo'),
                $request->request->get('observacao')
            );

            $this->get('registrar_chamado')->handle($command);

            $this->addFlash('success', 'Chamado registrado com sucesso');
            
        } catch (\InvalidArgumentException $e) {
            $this->addFlash('danger', $e->getMessage());
        }
        
        return $this->redirectToRoute('sac_index');
    }
    
    /**
     * @Route("/sac/relatorio", name="sac_relatorio")
     */
    public function relatorioAction(Request $request)
    {
        $qb = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Chamado')
            ->search($request->query);
        
        $paginator  = $this->get('knp_paginator');
        
        $pagination = $paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            5
        );
        
        return $this->render('sac/relatorio.html.twig', ['pagination' => $pagination]);
    }
}
