<?php
namespace App\Controller;


use App\Form\FilterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilterController extends AbstractController
{
    public function create(Request $request)
    {
        $form = $this->createForm(FilterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            return new Response('Done!');
        }

        return $this->render('form/filter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}