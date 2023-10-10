<?php

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_swa/assets/js/form.js');
?>

	<!--</style>-->
	<script type="text/javascript">
		getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function () {
			jQuery(document).ready(function () {
				jQuery('#form-member').submit(function (event) {
				});
			});
		});
	</script>

	<h1>Season Results</h1>

	<p>Below are the results for the current season so far.</p>

	<h2>Team Series</h2>
	<p>Competitions: <?php echo "{$this->teamItems['competitions']}, DNC score: {$this->teamItems['dnc_score']}" ?></p>
	<table class="table table-hover">
		<thead>
		<th>#</th>
		<th>Uni</th>
		<th>Team</th>
		<th>Points</th>
		<th>Competitions</th>
		<th>Discarded</th>
		</thead>
		<tbody>
		<?php
		$positionCounter = 0;

		foreach ($this->teamItems['results'] as $teamDetails)
		{
			$positionCounter++;

			// Name is technically use input so strip it just in case..
			$name = strip_tags($teamDetails['name']);
			echo "<tr>\n";
			echo "<td>{$positionCounter}</td>\n";
			echo "<td>{$name}</td>\n";
			echo "<td>{$teamDetails['team']}</td>\n";
			echo "<td>{$teamDetails['result']}</td>\n";
			echo "<td>{$teamDetails['competitions']}</td>\n";
			echo "<td>{$teamDetails['discard_points']}</td>\n";
			echo "</tr>\n";
		}

		echo "</tbody>\n";
		echo "</table>\n";

		foreach (array($this->individualItems, $this->genderItems) as $items)
		{
		foreach ($items

		as $seriesName => $seriesDetails)
		{
				echo "<h2>" . ucfirst($seriesName) . " Series</h2>\n";
				echo "<p>";
				echo "Competitions: {$seriesDetails['competitions']}";

				if ($seriesName != 'male' && $seriesName != 'female')
				{
					echo ", DNC score: {$seriesDetails['dnc_score']}";
					}

				echo "</p>";
				?>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Uni</th>
				<th>Points</th>
				<?php if ($seriesName == 'race')
				{
					echo "<th>Level</th>\n";
					echo "<th>Offset</th>\n";
					} ?>
				<th>Competitions</th>
				<th>DNCs</th>
				<th>DNC points</th>
				<th>Discarded</th>
			</tr>
			</thead>
			<tbody>
						<?php
						$positionCounter = 0;

						foreach ($seriesDetails['results'] as $resultDetails)
						{
							$positionCounter++;

							// Name is technically use input so strip it just in case..
							$name = strip_tags($resultDetails['name']);
							$uni  = strip_tags($resultDetails['university']);
							echo "<tr>\n";
							echo "<td>{$positionCounter}</td>\n";
							echo "<td>{$name}</td>\n";
							echo "<td>{$uni}</td>\n";
							echo "<td>{$resultDetails['result']}</td>\n";

							if ($seriesName == 'race')
							{
								$resultDetails['comp_type'] = str_replace(' race', '', $resultDetails['comp_type']);
								echo "<td>{$resultDetails['comp_type']}</td>\n";
								echo "<td>{$resultDetails['offset']}</td>\n";
							}

							echo "<td>{$resultDetails['competitions']}</td>\n";
							echo "<td>{$resultDetails['dnc_count']}</td>\n";
							echo "<td>{$resultDetails['dnc_points']}</td>\n";
							echo "<td>{$resultDetails['discard_points']}</td>\n";
							echo "</tr>\n";
							}

						echo "</tbody>\n";
						echo "</table>\n";
}
}
