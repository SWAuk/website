<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * University controller class.
 */
class Swa_universitiesControllerUniversity extends JControllerForm
{

    function __construct() {
        $this->view_list = 'universities';
        parent::__construct();
    }

}