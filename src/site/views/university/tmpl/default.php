<?php

defined( '_JEXEC' ) or die;

JHtml::_( 'behavior.keepalive' );
JHtml::_( 'behavior.tooltip' );
JHtml::_( 'behavior.formvalidation' );
JHtml::_( 'formbehavior.chosen', 'select' );

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );
$doc = JFactory::getDocument();
$doc->addScript( JUri::base() . '/components/com_swa/assets/js/form.js' );
?>

<!--</style>-->
<script type="text/javascript">
	getScript( '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function () {
		jQuery( document ).ready( function () {
			jQuery( '#form-member' ).submit( function ( event ) {
			} );
		} );
	} );
</script>

<h1>Your University Details</h1>

<table class="table">
	<thead></thead>
	<tbody>
		<tr>
			<div class="control-group">
				<td><label>University id<label></td>
				<td><?php echo $this->item->university_id ?></td>
			</div>
		</tr>

		<tr>
			<div class="control-group">
				<td><label>University</label></td>
				<td><?php echo $this->item->university ?></td>
			</div>
		</tr>

		<tr>
			<div class="control-group">
				<td><label>Url</label></td>
				<td><a href="<?php echo $this->item->url ?>"><?php echo $this->item->url ?></a></td>
			</div>
		</tr>
	</tbody>
</table>