<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Tickettype controller class.
 */
class SwaControllerTickettype extends JControllerForm
{

    function __construct() {
        $this->view_list = 'tickettypes';
        parent::__construct();
    }

}