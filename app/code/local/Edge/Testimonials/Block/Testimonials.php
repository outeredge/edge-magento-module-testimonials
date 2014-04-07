<?php

class Edge_Testimonials_Block_Testimonials extends Mage_Core_Block_Template
{
    public function getTestimonials()
    {
        return Mage::getModel('testimonials/testimonials')->getCollection();
    }
}