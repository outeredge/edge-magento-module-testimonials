<?php

$this->startSetup();

// Testimonials
$this->run("
    CREATE TABLE IF NOT EXISTS {$this->getTable('testimonials/testimonials')} (
        `id` int(11) primary key NOT NULL auto_increment,
        `name` text NULL DEFAULT NULL,
        `company` text NULL DEFAULT NULL,
        `position` text NULL DEFAULT NULL,
        `quote` text NULL DEFAULT NULL,
        `image` text NULL DEFAULT NULL,
        `sort_order` int(11) NOT NULL DEFAULT '0'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$this->endSetup();