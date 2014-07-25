<?php
/**
 * @version     0.0.1
 * @package     com_swa
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later
 * @author      Adam <adamshorland@gmail.com> - http://studentwindsurfing.co.uk
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Season controller class.
 */
class SwaControllerSeason extends JControllerForm
{

    function __construct() {
        $this->view_list = 'seasons';
        parent::__construct();
    }

}