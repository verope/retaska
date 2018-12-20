<?php

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/basket")
 */
class ViewsCountController extends AbstractController
{
    /**
     * @Route("/show", name="views_show")
     */
    public function updateViewsCount(SessionInterface $session): Response
    {
        // načtení počtu ze session (defaultní hodnota je 0)
        $basketCount = $session->get('basket', '');
        
        // změna hodnoty - přičtení jedné
        $basketCount++;
        
        // uložení nové hodnoty do session
        $session->set('basket', $viewsCount);
        
        // vykreslení šablony
        $this->render('basket_count/index.html.twig', ['basket' => $viewsCount]);
    }
}