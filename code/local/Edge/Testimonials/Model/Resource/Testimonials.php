<?php

class Edge_Testimonials_Model_Resource_Testimonials extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('testimonials/testimonials', 'id');
    }
}
