<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2020 John Smith. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
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

		<h1>Welcome to the Org backend FROM TMPL NOT SWA!</h1>

		<p>The component is currently made of com_swa and plg_swa_viewlevels both of which can be
			found on <a href="https://github.com/SWAuk">github</a>.</p>

		<h2>General Logic & Flow</h2>

		<h3>Members</h3>

		<ol>
			<li>The site is public, so anyone can view the majority of the content.</li>
			<li>To become a member of the Org a user must first create a Joomla account.</li>
			<li>They must then fill out some Org specific information.</li>
			<li>They must then pay the membership.</li>
			<li>They will then be a member!</li>
		</ol>

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

	</div>
