<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn  = $this->state->get('list.direction');
$canEdit   = $user->authorise('core.edit', 'com_swa');
?>

<script type="text/javascript">
	Joomla.orderTable = function () {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		dirn = direction.options[direction.selectedIndex].value;
		Joomla.tableOrdering(order, dirn, '');
	}
</script>

<?php
// Joomla Component Creator code to allow adding non select list filters
if (!empty($this->extra_sidebar))
{
	$this->sidebar .= $this->extra_sidebar;
}
?>

<form method="post" name="adminForm" id="adminForm">
	<div id="j-sidebar-container" class="span2"><?php echo $this->sidebar; ?></div>


	<div id="j-main-container" class="span10">
		<div id="adminview-description">
			<p>Here you can see and add Member's yearly membership.</p>
			<p>
				New Members must buy a membership each year. Lifetime members don't have to pay but have to follow the
				same process of selecting their uni and level to gain a membership each year.
			</p>
		</div>

		<div id="filter-bar" class="btn-toolbar">
			<!-- Search bar -->
			<div class="filter-search btn-group pull-left">
				<label for="filter_search" class="element-invisible">
					<?php echo JText::_('JSEARCH_FILTER'); ?>
				</label>
				<input type="text" name="filter_search" id="filter_search"
				       placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>"
				       value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
				       title="<?php echo JText::_('JSEARCH_FILTER'); ?>"/>
			</div>
			<!-- Search and clear buttons -->
			<div class="btn-group pull-left">
				<button class="btn hasTooltip" type="submit"
				        title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>">
					<i class="icon-search"></i>
				</button>
				<button class="btn hasTooltip" type="button"
				        title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>"
				        onclick="getElementById('filter_search').value=''; this.form.submit();">
					<i class="icon-remove"></i>
				</button>
			</div>

			<!-- Items per page dropdown -->
			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
			<!-- Order direction dropdown -->
			<div class="btn-group pull-right hidden-phone">
				<label for="directionTable" class="element-invisible">
					<?php echo JText::_('JFIELD_ORDERING_DESC'); ?>
				</label>
				<select name="directionTable" id="directionTable"
				        class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></option>
					<option value="asc" <?php echo ($listDirn == 'asc') ? 'selected="selected"' : '' ?>>
						<?php echo JText::_('JGLOBAL_ORDER_ASCENDING'); ?>
					</option>
					<option value="desc" <?php echo ($listDirn == 'desc') ? 'selected="selected"' : '' ?>>
						<?php echo JText::_('JGLOBAL_ORDER_DESCENDING'); ?>
					</option>
				</select>
			</div>
			<!-- Order by dropdown -->
			<div class="btn-group pull-right">
				<label for="sortTable" class="element-invisible">
					<?php echo JText::_('JGLOBAL_SORT_BY'); ?>
				</label>
				<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JGLOBAL_SORT_BY'); ?></option>
					<?php echo JHtml::_('select.options', $this->getSortFields(), 'value', 'text', $listOrder); ?>
				</select>
			</div>
		</div>


		<?php // TODO: echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

		<?php if (empty($this->items)) : ?>
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php else : ?>
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th width="1%" class="hidden-phone">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_('grid.sort', 'Season', 'season', $listDirn, $listOrder); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_('grid.sort', 'Member', 'member_name', $listDirn, $listOrder); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_('grid.sort', 'Paid', 'paid', $listDirn, $listOrder); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_('grid.sort', 'Level', 'level', $listDirn, $listOrder); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_('grid.sort', 'University', 'university', $listDirn, $listOrder); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_('grid.sort', 'Approved', 'approved', $listDirn, $listOrder); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_('grid.sort', 'Committee', 'committee', $listDirn, $listOrder); ?>
					</th>
				</tr>
				</thead>

				<tfoot>
				<tr>
					<td colspan="100%">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
				</tfoot>

				<tbody>
				<?php foreach ($this->items as $i => $item): ?>
					<tr>
						<td class="center hidden-phone">
							<?php if ($canEdit || $canChange) : ?>
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							<?php endif; ?>
						</td>
						<td><?php echo $item->season ?></td>
						<td><?php echo $item->member_name ?></td>
						<td><?php echo $item->paid ?></td>
						<td><?php echo $item->level ?></td>
						<td><?php echo $item->university ?></td>
						<td><?php echo $item->approved ?></td>
						<td><?php echo $item->committee ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>
