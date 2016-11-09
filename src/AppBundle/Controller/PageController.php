<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ContactType;
use AppBundle\Model\Contact;


class PageController extends Controller
{
    public function contactAction(Request $request){
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name = $form->get('name');
            $email= $form->get('email');
            $message = $form->get('message');

            $message = \Swift_Message::newInstance()
                ->setSubject('Contact Email')
                ->setFrom('enquiry@booksonline.com')
                ->setTo('wisdomwiz1000@gmail.com')
                ->setBody(
                    $this->renderView('AppBundle:Emails:contact.html.twig',
                        array('contact'=>$contact)
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            $this->addFlash('contact_success','Your enquiry has been received we will get back to you soon, Thanks.');
            return $this->redirectToRoute('booksonline_contact');
        }
        return $this->render('AppBundle:Pages:contact.html.twig', array('form'=>$form->createView()));
    }
    
    public function aboutAction(){
        return $this->render('AppBundle:Pages:about.html.twig');
    }
    
    public function termsAction(){
        return $this->render('AppBundle:Pages:terms.html.twig');
    }
    
    public function privacyAction(){
        return $this->render('AppBundle:Pages:privacy.html.twig');
    }

    public function faqAction(){
        return $this->render('AppBundle:Pages:faq.html.twig');
    }
}