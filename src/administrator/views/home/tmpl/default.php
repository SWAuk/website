<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<?php if (!empty($this->sidebar))
:
?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<?php else
	:
	?>
	<div id="j-main-container">
		<?php endif; ?>

		<h1>Welcome to the Org backend!</h1>

		<p>Here are some basic but important notes about how this component works...</p>

		<h2>Installation / Composition</h2>

		<p>The component is currently made of com_swa and plg_swa_viewlevels both of which can be
			found on <a href="https://github.com/SWAuk">github</a>.</p>

		<p>To install the most recent versions clone the repositories, run make.php (which creates a
			zip) and upload that zip to Joomla (Extensions > Manage).</p>

		<h2>General Logic & Flow</h2>

		<h3>Members</h3>

		<ol>
			<li>The site is public, so anyone can view the majority of the content.</li>
			<li>To become a member of the Org a user must first create a Joomla account.</li>
			<li>They must then fill out some Org specific information.</li>
			<li>They must then pay the membership.</li>
			<li>They will then be a member!</li>
		</ol>

		<p>This can be seen as slightly confusing and may be tackeled before the 2016-2017
			season.</p>

		<p>TODO: Qualifications</p>

		<h3>Events and Tickets</h3>

		<ul>
			<li>First an 'Event' must be created.</li>
			<li>In order to mark a uni or collection of unis as an event host they must be added to
				the 'Event Host' table.
			</li>
			<li>Next 'Event Tickets' must be created for the event.</li>
			<li>Members of clubs must be registered for an event in order to buy a ticket. This
				would add them to the 'Event Registrations' table.
			</li>
			<li>When members buy a ticket an entry will be added to the 'Tickets' table.</li>
		</ul>

		<h3>Competitions & Results</h3>

		<p>TBA</p>

		<h3>Damages, Grants & Deposits</h3>

		<p>TBA</p>

	</div>
