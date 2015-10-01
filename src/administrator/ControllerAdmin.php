<?php

class SwaControllerAdmin extends JControllerAdmin{

	public function postDeleteHook( JModelLegacy $model, $id = null ) {
		parent::postDeleteHook($model, $id);

		JLog::add(
			implode( ', ', array(
				JFactory::getUser()->name,
				get_called_class() . '::' . 'delete',
				'id = ' . $id
			) ),
			JLog::INFO,
			'com_swa.audit_backend'
		);
	}

}
