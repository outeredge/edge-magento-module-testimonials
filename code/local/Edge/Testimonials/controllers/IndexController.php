<?php

class Edge_Testimonials_IndexController extends Mage_Core_Controller_Front_Action
{
    /*
     * Displays the masonryJS style page
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function ajaxProductsAction()
    {
        $page = Mage::app()->getRequest()->getParam('page', 0);

        $products = Mage::getModel('testimonials/testimonials')
            ->getCollection();

        $products->getSelect()->order('position', 'ASC');
        $products->getSelect()->limitPage($page, 13);

        $this->getResponse()
             ->clearHeaders()
             ->setHeader('Content-Type', 'application/json')
             ->setBody(json_encode($products->getData()));

        return;
    }
}