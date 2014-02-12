<?php

class Edge_Testimonials_Model_Testimonials extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('testimonials/testimonials');
    }
    
    public function getTestimonialsProducts()
	{
		$products = $this->getTestimonialsProductsJson();
		if ($products){
			return json_decode($products, true);
		}
		return array();
	}
	
	public function getTestimonialsProductsJson()
	{
		$products = $this->getData('products');
		if ($products){
			return $products;
		}
        return false;
	}
    
    public function getUrl()
    {
        return Mage::getUrl('testimonials') . '#celeb' . $this->getId();
    }
    
    public function getImageSrc()
    {
        return Mage::getBaseUrl('media') . $this->getImage();
    }    
}
