<?php
namespace AppBundle\Controller;

use Sylius\Bundle\ShopBundle\Controller\HomepageController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class HomepageController extends BaseController
{
    private $templatingEngine;

    public function getTemplatingEngine()
    {
        return $this->templatingEngine;
    }

    public function __construct(EngineInterface $templatingEngine)
    {
        parent::__construct($templatingEngine);
    }

    public function indexAction(Request $request)
    {

        return parent::indexAction($request);

    }
}