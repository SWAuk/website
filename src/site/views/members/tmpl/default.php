<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user       = JFactory::getUser();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canOrder   = $user->authorise('core.edit.state', 'com_swa');
$sortFields = $this->getSortFields();
?>
<script type="text/javascript">
	Joomla.orderTable = function () {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>') {
			dirn = 'asc';
		} else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_swa&view=members'); ?>" method="post"
      name="adminForm" id="adminForm">
	<div class="clearfix"></div>
	<table class="table table-striped" id="memberList">
		<thead>
		<tr>
			<th width="1%" class="hidden-phone">
				<input type="checkbox" name="checkall-toggle" value=""
				       title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
				       onclick="Joomla.checkAll(this)"/>
			</th>

			<th width="1%" class="nowrap center hidden-phone">
				<?php echo JHtml::_(
					'grid.sort',
					'JGRID_HEADING_ID',
					'id',
					$listDirn,
					$listOrder
				); ?>
			</th>
			<th class='left'>
				<?php echo JHtml::_('grid.sort', 'Name', 'name', $listDirn, $listOrder); ?>
			</th>
			<th class='left'>
				<?php echo JHtml::_(
					'grid.sort',
					'University',
					'university',
					$listDirn,
					$listOrder
				); ?>
			</th>
			<th class='left'>
				<?php echo JHtml::_('grid.sort', 'Paid', 'paid', $listDirn, $listOrder); ?>
			</th>
		</tr>
		</thead>
		<tfoot>
		<?php
		if (isset($this->items[0]))
		{
			$colspan = count(get_object_vars($this->items[0]));
		}
		else
		{
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
		<?php
		foreach ($this->items as $i => $item):
			$ordering = ($listOrder == 'ordering');
			$canCreate = $user->authorise('core.create', 'com_swa');
			$canEdit = $user->authorise('core.edit', 'com_swa');
			$canCheckin = $user->authorise('core.manage', 'com_swa');
			$canChange = $user->authorise('core.edit.state', 'com_swa');
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center hidden-phone">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>

				<td class="center hidden-phone">
					<?php echo (int) $item->id; ?>
				</td>
				<td>
					<?php echo $item->name; ?>
				</td>
				<td>
					<?php echo $item->university; ?>
				</td>
				<td>
					<?php
					// Check if the member has paid their SWA membership
					if ($item->season_id != null || $item->lifetime_member)
					{
						echo "Yes";
					}
					else
					{
						echo "No";
					} ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
