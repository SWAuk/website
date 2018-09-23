<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_swa/assets/css/swa.css');

$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn  = $this->state->get('list.direction');
$canOrder  = $user->authorise('core.edit.state', 'com_swa');
$saveOrder = $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_swa&task=deposits.saveOrderAjax&tmpl=component';
	JHtml::_(
		'sortablelist.sortable',
		'depositList',
		'adminForm',
		strtolower($listDirn),
		$saveOrderingUrl
	);
}
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

<?php
// Joomla Component Creator code to allow adding non select list filters
if (!empty($this->extra_sidebar))
{
	$this->sidebar .= $this->extra_sidebar;
}
?>

<form action="<?php echo JRoute::_('index.php?option=com_swa&view=deposits'); ?>" method="post"
      name="adminForm" id="adminForm">
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
			<div id="adminview-description">
				<p>Here you can see and add deposits for universities.</p>
			</div>
			<div id="filter-bar" class="btn-toolbar">
				<div class="btn-group pull-right hidden-phone">
					<label for="limit" class="element-invisible"><?php echo JText::_(
							'JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'
						); ?></label>
					<?php echo $this->pagination->getLimitBox(); ?>
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="directionTable" class="element-invisible"><?php echo JText::_(
							'JFIELD_ORDERING_DESC'
						); ?></label>
					<select name="directionTable" id="directionTable" class="input-medium"
					        onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></option>
						<option value="asc" <?php if ($listDirn == 'asc')
						{
							echo 'selected="selected"';
						} ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING'); ?></option>
						<option value="desc" <?php if ($listDirn == 'desc')
						{
							echo 'selected="selected"';
						} ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING'); ?></option>
					</select>
				</div>
				<div class="btn-group pull-right">
					<label for="sortTable" class="element-invisible"><?php echo JText::_(
							'JGLOBAL_SORT_BY'
						); ?></label>
					<select name="sortTable" id="sortTable" class="input-medium"
					        onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_('JGLOBAL_SORT_BY'); ?></option>
						<?php echo JHtml::_(
							'select.options',
							$sortFields,
							'value',
							'text',
							$listOrder
						); ?>
					</select>
				</div>
			</div>
			<div class="clearfix"></div>
			<table class="table table-striped" id="depositList">
				<thead>
				<tr>
					<?php if (isset($this->items[0]->ordering))
						:
						?>
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo JHtml::_(
								'grid.sort',
								'<i class="icon-menu-2"></i>',
								'a.ordering',
								$listDirn,
								$listOrder,
								null,
								'asc',
								'JGRID_HEADING_ORDERING'
							); ?>
						</th>
					<?php endif; ?>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value=""
						       title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
						       onclick="Joomla.checkAll(this)"/>
					</th>

					<th class='left'>
						<?php echo JHtml::_(
							'grid.sort',
							'University',
							'a.university',
							$listDirn,
							$listOrder
						); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_(
							'grid.sort',
							'Date',
							'a.date',
							$listDirn,
							$listOrder
						); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_(
							'grid.sort',
							'Amount',
							'a.amount',
							$listDirn,
							$listOrder
						); ?>
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
				<?php foreach ($this->items as $i => $item)
					:
					$ordering = ($listOrder == 'a.ordering');
					$canCreate = $user->authorise('core.create', 'com_swa');
					$canEdit = $user->authorise('core.edit', 'com_swa');
					$canCheckin = $user->authorise('core.manage', 'com_swa');
					$canChange = $user->authorise('core.edit.state', 'com_swa');
					?>
					<tr class="row<?php echo $i % 2; ?>">

						<?php if (isset($this->items[0]->ordering))
							:
							?>
							<td class="order nowrap center hidden-phone">
								<?php if ($canChange)
									:
									$disableClassName = '';
									$disabledLabel = '';
									if (!$saveOrder)
										:
										$disabledLabel    = JText::_('JORDERINGDISABLED');
										$disableClassName = 'inactive tip-top';
									endif; ?>
									<span
										class="sortable-handler hasTooltip <?php echo $disableClassName ?>"
										title="<?php echo $disabledLabel ?>">
							<i class="icon-menu"></i>
						</span>
									<input type="text" style="display:none" name="order[]" size="5"
									       value="<?php echo $item->ordering; ?>"
									       class="width-20 text-area-order "/>
								<?php else
									:
									?>
									<span class="sortable-handler inactive">
							<i class="icon-menu"></i>
						</span>
								<?php endif; ?>
							</td>
						<?php endif; ?>
						<td class="center hidden-phone">
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
						<td>
							<?php echo $item->university; ?>
						</td>
						<td>
							<?php echo $item->date; ?>
						</td>
						<td>
							<?php echo $item->amount; ?>
						</td>
						<td class="center hidden-phone">
							<?php echo (int) $item->id; ?>
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


