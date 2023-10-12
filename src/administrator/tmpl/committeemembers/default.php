<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

//JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user   = Factory::getApplication()->getIdentity();
$userId = $user->id;

$listOrder = $this->state->get('list.ordering');
$listDirn  = $this->state->get('list.direction');
$canChange = $user->authorise('core.edit.state', 'com_swa');

$saveOrder = $listOrder == 'ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_swa&task=committeemembers.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'committeememberList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

$sortFields = $this->getSortFields();
?>

<script type="text/javascript">
	Joomla.orderTable = function () {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order !== '<?= $listOrder ?>') {
			dirn = 'asc';
		} else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>

<?php

if (!empty($this->extra_sidebar))
{
	$this->sidebar .= $this->extra_sidebar;
}
?>

<form method="post" name="adminForm" id="adminForm">
	<?php if (!empty($this->sidebar))
	:
	?>
	<div id="j-sidebar-container" class="span2">
		<?= $this->sidebar ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else
		:
		?>
		<div id="j-main-container">
			<?php endif; ?>
			<div id="adminview-description">
				<p>Here you can see, add and edit members of the Org committee.</p>

				<p>Everyone in this list will appear in the 'committee' frontend view and also be
					given access anything with the 'Org committee' view level.</p>

				<p>Members in this list can also purchase tickets marked as 'Needs SWA'.</p>
			</div>
			<div id="filter-bar" class="btn-toolbar">
				<div class="filter-search btn-group pull-left">
					<label for="filter_search" class="element-invisible">
						<?= Text::_('JSEARCH_FILTER') ?>
					</label>
					<input type="search" name="filter_search" id="filter_search"
					       placeholder="<?= Text::_('JSEARCH_FILTER') ?>"
					       value="<?= $this->escape($this->state->get('filter.search')) ?>"
					       title="<?= Text::_('JSEARCH_FILTER') ?>"/>
				</div>
				<div class="btn-group pull-left">
					<button class="btn hasTooltip" type="submit"
					        title="<?= Text::_('JSEARCH_FILTER_SUBMIT') ?>">
						<i class="icon-search"></i>
					</button>
					<button class="btn hasTooltip" type="button"
					        title="<?= Text::_('JSEARCH_FILTER_CLEAR') ?>"
					        onclick="getElementById('filter_search').value='';this.form.submit();">
						<i class="icon-remove"></i>
					</button>
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="limit" class="element-invisible">
						<?= Text::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC') ?>
					</label>
					<?= $this->pagination->getLimitBox() ?>
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="directionTable" class="element-invisible">
						<?= Text::_('JFIELD_ORDERING_DESC') ?>
					</label>
					<select name="directionTable" id="directionTable" class="input-medium"
					        onchange="Joomla.orderTable()">
						<option value=""><?= Text::_('JFIELD_ORDERING_DESC') ?></option>
						<option value="asc" <?= ( $listDirn == 'asc') ? 'selected="selected"' : '' ?>>
							<?= Text::_('JGLOBAL_ORDER_ASCENDING') ?>
						</option>
						<option value="desc" <?= ( $listDirn == 'desc') ? 'selected="selected"' : '' ?>>
							<?= Text::_('JGLOBAL_ORDER_DESCENDING') ?>
						</option>
					</select>
				</div>
				<div class="btn-group pull-right">
					<label for="sortTable" class="element-invisible">
						<?= Text::_('JGLOBAL_SORT_BY') ?>
					</label>
					<select name="sortTable" id="sortTable" class="input-medium"
					        onchange="Joomla.orderTable()">
						<option value=""><?= Text::_('JGLOBAL_SORT_BY') ?></option>
						<?= JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder) ?>
					</select>
				</div>
			</div>
			<div class="clearfix"></div>

			<table class="table table-striped" id="committeememberList">
				<thead>
				<tr>
					<th class="nowrap center hidden-phone">
						<?= JHtml::_(
							'grid.sort',
							'<i class="icon-menu-2"></i>',
							'ordering',
							$listDirn,
							$listOrder,
							null,
							'asc',
							'JGRID_HEADING_ORDERING'
						) ?>
					</th>
					<th class="hidden-phone">
						<?= JHtml::_('grid.checkall') ?>
					</th>
					<th class="nowrap center hidden-phone">
						<?= JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'id', $listDirn, $listOrder) ?>
					</th>
					<th class='left'>
						<?= JHtml::_('grid.sort', 'Member', 'member', $listDirn, $listOrder) ?>
					</th>
					<th class='left'>
						<?= JHtml::_('grid.sort', 'Position', 'position', $listDirn, $listOrder) ?>
					</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<td colspan="100%">
						<?= $this->pagination->getListFooter() ?>
					</td>
				</tr>
				</tfoot>
				<tbody>
				<?php foreach ($this->items as $i => $item)
					:
					$link = 'index.php?option=com_swa&task=committeemember.edit&id=' . (int) $item->id;
					?>
					<tr class="row<?= $i % 2 ?>">
						<td class="order nowrap center hidden-phone">
							<?php
							$iconClass  = '';
							$assetName  = 'com_swa.committeemembers.' . (int) $item->id;
							$canReorder = $user->authorise('core.edit.state', $assetName);

							if (!$canReorder)
							{
								$iconClass = ' inactive';
							}
							elseif (!$saveOrder)
							{
								$orderingDisabled = JHtml::_('tooltipText', 'JORDERINGDISABLED');
								$iconClass        = ' inactive tip-top hasTooltip" title="' . $orderingDisabled;
							}
							?>
							<span class="sortable-handler<?= $iconClass ?>">
								<span class="icon-menu" aria-hidden="true"></span>
							</span>
							<?php if ($canReorder && $saveOrder)
								:
								?>
								<input name="order[]" class="width-20 text-area-order" type="text"
								       style="display:none" size="5" value="<?= $item->ordering ?>"/>
							<?php endif; ?>
						</td>
						<td class="center hidden-phone">
							<?= JHtml::_('grid.id', $i, $item->id) ?>
						</td>
						<td class="center hidden-phone">
							<?= (int) $item->id ?>
						</td>
						<td>
							<a href="<?= $link ?>">
								<?= $item->member ?>
							</a>
						</td>
						<td>
							<?= $item->position ?>
						</td>

					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<input type="hidden" name="task" value=""/>
			<input type="hidden" name="boxchecked" value="0"/>
			<input type="hidden" name="filter_order" value="<?= $listOrder ?>"/>
			<input type="hidden" name="filter_order_Dir" value="<?= $listDirn ?>"/>
			<?= JHtml::_('form.token') ?>
		</div>
</form>

