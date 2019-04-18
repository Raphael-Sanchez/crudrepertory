<?php

namespace  App\Controller;

use App\Entity\Contact;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class RepertoryController
{
    public function index(Environment $twig, RegistryInterface $doctrine)
    {
        $contacts = $doctrine->getRepository(Contact::class)->findBy([], ['lastname' => 'ASC']);;

        return new Response(
            $twig->render('repertory/index.html.twig', compact('contacts'))
        );
    }

    public function searchAjax(Request $request, RegistryInterface $doctrine, Environment $twig)
    {
        $toSearchValue = $request->query->get('toSearch');
        // If value to research is not null, not empty, and superior at 2, we loads and send contacts by terms of research value
        if ($toSearchValue !== null && $toSearchValue !== '' && strlen($toSearchValue) >= 2)
        {
            $toSearchValueTrimed = array_map('trim', explode(' ', $toSearchValue));
            $termsToSearch = array_values(array_filter($toSearchValueTrimed));

            $contacts = $doctrine->getRepository(Contact::class)->findByTerms($termsToSearch);
            $htmlToRender = $twig->render('repertory/listing.html.twig', compact('contacts'));

            return new Response($htmlToRender);
        }

        // Else, if research value is empty, or null, or inferior at 2 we return all contacts (action by default)
        $contacts = $doctrine->getRepository(Contact::class)->findAll();
        $htmlToRender = $twig->render('repertory/listing.html.twig', compact('contacts'));

        return new Response($htmlToRender);
    }
}