<?php

// no direct access
defined( '_JEXEC' ) or die;

JHtml::addIncludePath( JPATH_COMPONENT . '/helpers/html' );
JHtml::_( 'bootstrap.tooltip' );
JHtml::_( 'behavior.multiselect' );
JHtml::_( 'formbehavior.chosen', 'select' );

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet( 'components/com_swa/assets/css/swa.css' );

$user = JFactory::getUser();
$userId = $user->get( 'id' );
$listOrder = $this->state->get( 'list.ordering' );
$listDirn = $this->state->get( 'list.direction' );
$canOrder = $user->authorise( 'core.edit.state', 'com_swa' );
$sortFields = $this->getSortFields();
?>
<script type="text/javascript">
	Joomla.orderTable = function () {
		table = document.getElementById( "sortTable" );
		direction = document.getElementById( "directionTable" );
		order = table.options[ table.selectedIndex ].value;
		if ( order != '<?php echo $listOrder; ?>' ) {
			dirn = 'asc';
		} else {
			dirn = direction.options[ direction.selectedIndex ].value;
		}
		Joomla.tableOrdering( order, dirn, '' );
	}
</script>

<h1>Org Members with Qualifications</h1>

<p>Below is a list of all members with Qualifications.</p>

<form action="<?php echo JRoute::_( 'index.php?option=com_swa&view=qualifications' ); ?>"
	  method="post" name="adminForm" id="adminForm">
	<div class="clearfix"></div>
	<table class="table table-striped" id="qualificationsList">
		<thead>
		<tr>
			<th width="1%" class="hidden-phone">
				<input type="checkbox" name="checkall-toggle" value=""
					   title="<?php echo JText::_( 'JGLOBAL_CHECK_ALL' ); ?>"
					   onclick="Joomla.checkAll(this)"/>
			</th>

			<th width="1%" class="nowrap center hidden-phone">
				<?php echo JHtml::_(
					'grid.sort',
					'JGRID_HEADING_ID',
					'a.id',
					$listDirn,
					$listOrder
				); ?>
			</th>
			<th class='left'>
				<?php echo JHtml::_( 'grid.sort', 'Member', 'a.member', $listDirn, $listOrder ); ?>
			</th>
			<th class='left'>
				<?php echo JHtml::_( 'grid.sort', 'Type', 'a.type', $listDirn, $listOrder ); ?>
			</th>
			<th class='left'>
				<?php echo JHtml::_( 'grid.sort', 'Expiry', 'a.expiry', $listDirn, $listOrder ); ?>
			</th>
		</tr>
		</thead>
		<tfoot>
		<?php
		if ( isset( $this->items[0] ) ) {
			$colspan = count( get_object_vars( $this->items[0] ) );
		} else {
			$colspan = 10;
		}
		?>
		<tr>
			<td colspan="<?php echo $colspan ?>">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
		</tfoot>
		<tbody>
		<?php foreach ( $this->items as $i => $item ) :
			$ordering = ( $listOrder == 'a.ordering' );
			$canCreate = $user->authorise( 'core.create', 'com_swa' );
			$canEdit = $user->authorise( 'core.edit', 'com_swa' );
			$canCheckin = $user->authorise( 'core.manage', 'com_swa' );
			$canChange = $user->authorise( 'core.edit.state', 'com_swa' );
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center hidden-phone">
					<?php echo JHtml::_( 'grid.id', $i, $item->id ); ?>
				</td>

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
				?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_( 'form.token' ); ?>
	</div>
</form>
