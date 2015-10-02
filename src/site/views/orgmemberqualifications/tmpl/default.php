<?php

// no direct access
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

<h1>Org Members with Qualifications</h1>

<p>Below is a list of all members with Qualifications.</p>

	<table class="table table-striped" id="qualificationsList">
		<thead>
		<tr>
			<th class='left'>Id</th>
			<th class='left'>Member</th>
			<th class='left'>Type</th>
			<th class='left'>Expiry</th>
			<th class='left'>Approved</th>
			<th class='left'>File</th>
			<th class='left'>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ( $this->items as $i => $item ) :
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center hidden-phone">
					<?php echo (int)$item->id; ?>
				</td>
				<td>
					<?php echo $item->member; ?>
				</td>
				<td>
					<?php echo $item->type; ?>
				</td>
				<?php
				if ( new DateTime( $item->expiry ) < new DateTime() ) {
					echo "<td bgcolor='#FF6666'>";
				} else {
					echo "<td>";
				}
				echo $item->expiry;
				echo "</td>";

				if ( !$item->approved ) {
					echo "<td bgcolor='#FF6666'>";
				} else {
					echo "<td>";
				}
				echo $item->approved;
				echo "</td>";

				?>
			<?php
			$imgSrc =
				JRoute::_(
					'index.php?option=com_swa&task=orgmemberqualifications.viewImage&qualification=' .
					$item->id
				);
			echo "<td><a href='$imgSrc'><img src='$imgSrc' height='50' width='50'/></a></td>\n";
			?>
				<td>
					<?php
					if ( !$item->approved ) {
						echo '<td><form id="form-orgmemberqualifications-approve-' .
							$item->id . '" method="POST" action="' .
							JRoute::_( 'index.php?option=com_swa&task=orgmemberqualifications.approve' ) .
							'">' .
							'<input type="hidden" name ="qualification" value="' . $item->id . '" />' .
							'<a href="javascript:{}" onclick="document.getElementById(\'form-orgmemberqualifications-approve-' .
							$item->id .
							'\').submit(); return false;">(approve)</a>' .
							JHtml::_( 'form.token' ) .
							'</form></td>';
					} else {
						echo '<td><form id="form-orgmemberqualifications-unapprove-' .
							$item->id . '" method="POST" action="' .
							JRoute::_( 'index.php?option=com_swa&task=orgmemberqualifications.unapprove' ) .
							'">' .
							'<input type="hidden" name ="qualification" value="' . $item->id . '" />' .
							'<a href="javascript:{}" onclick="document.getElementById(\'form-orgmemberqualifications-unapprove-' .
							$item->id .
							'\').submit(); return false;">(unapprove)</a>' .
							JHtml::_( 'form.token' ) .
							'</form></td>';
					}
					?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

