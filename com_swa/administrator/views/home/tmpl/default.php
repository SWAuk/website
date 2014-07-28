<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<?php if (!empty( $this->sidebar )): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container">
		<?php endif; ?>

		<h1><?php echo $this->header; ?></h1>

		<p><?php echo $this->message; ?></p>

	</div>