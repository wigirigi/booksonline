<?php
namespace AppBundle\Controller;

use AppBundle\Model\Contact;
use AppBundle\Form\ContactType;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class ResourceController extends BaseController
{
    public function showAction(Request $request)
    {
        return parent::showAction($request);
    }
    public function indexAction(Request $request)
    {
        return parent::indexAction($request); 
    }
    public function contactAction(Request $request){
        $model = new Contact();
        $form = $this->createForm(ContactType::class, $model);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name = $form->get('name');
            $email= $form->get('email');
            $message = $form->get('message');

            $message = \Swift_Message::newInstance()
                ->setSubject('Contact Email')
                ->setFrom($email)
                ->setTo('wisdomwiz1000@gmail.com')
                ->setBody(
                    $this->renderView('AppBundle:Emails:contact.html.twig',
                        array('name' => $name,
                            'email'=>$email,
                            'message'=>$message)
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag('contact_success','Your enquiry has been received we will get back to you soon, Thanks.');
            return $this->redirectToRoute('booksonline_contact');
        }
        return $this->render('AppBundle:Pages:contact.html.twig', array('form'=>$form->createView()));
    }

}