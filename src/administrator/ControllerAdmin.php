<?php

class SwaControllerAdmin extends JControllerAdmin {
	/**
	 * Extends the postDeleteHook function to log which items were delted.
	 * This is done for all classes the inherit SwaControllerAdmin.
	 *
	 * @param	JModelLegacy	$model	The data model object
	 * @param	int[]|null  	$ids	The array of ids for items being deleted
	 *
	 * @return	void
	 */
	public function postDeleteHook( JModelLegacy $model, $ids = null ) {
		parent::postDeleteHook( $model, $ids );

		$user_name = JFactory::getUser()->name;
		$class = get_called_class();
		$ids = implode(', ', $ids);

		JLog::add( "{$user_name} {$class}::delete [{$ids}]", JLog::INFO, 'com_swa.audit_backend' );
	}

}
