<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    public function create(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $contact = $form->getData();
            $contact->setCreatedAt(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('contact/form/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contact = $entityManager->getRepository(Contact::class)->find($id);
        if (!$contact) {
            return $this->redirectToRoute('index');
        }

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('contact/form/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contact = $entityManager->getRepository(Contact::class)->find($id);
        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('index');
    }
}
