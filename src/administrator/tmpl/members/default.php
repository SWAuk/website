<?php

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user      = Factory::getApplication()->getIdentity();
$userId    = $user->id;
$listOrder = $this->state->get('list.ordering');
$listDirn  = $this->state->get('list.direction');
$canOrder  = $user->authorise('core.edit.state', 'com_swa');
$canEdit   = $user->authorise('core.edit', 'com_swa');
$saveOrder = $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_swa&task=members.saveOrderAjax&tmpl=component';
	HTMLHelper::_(
		'sortablelist.sortable',
		'memberList',
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
		if (order !== '<?= $listOrder ?>') {
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

<form action="<?= Route::_('index.php?option=com_swa&view=members') ?>"
      method="post" name="adminForm" id="adminForm">
	<?php if (!empty($this->sidebar))
	:
	?>
	<div id="j-sidebar-container" class="span2"><?= $this->sidebar ?></div>
	<div id="j-main-container" class="span10">
		<?php else
		:
		?>
		<div id="j-main-container">
			<?php endif; ?>
			<div id="adminview-description">
				<p>Here you can see and add members of the Org. This list is different to the Joomla Users list.</p>
				<p>People must register on the site (Joomla) before they can become a member of the Org.</p>
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
					<select name="directionTable" id="directionTable"
					        class="input-medium" onchange="Joomla.orderTable()">
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
					<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
						<option value=""><?= Text::_('JGLOBAL_SORT_BY') ?></option>
						<?= Text::_('select.options', $sortFields, 'value', 'text', $listOrder) ?>
					</select>
				</div>
			</div>

			<div class="clearfix"></div>
			<table class="table table-striped" id="memberList">
				<thead>
				<tr>
					<?php if (isset($this->items[0]->ordering))
						:
						?>
						<th width="1%" class="nowrap center hidden-phone">
							<?= HTMLHelper::_(
								'grid.sort',
								'<i class="icon-menu-2"></i>',
								'a.ordering',
								$listDirn,
								$listOrder,
								null,
								'asc',
								'JGRID_HEADING_ORDERING'
							) ?>
						</th>
					<?php endif; ?>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value=""
						       title="<?= Text::_('JGLOBAL_CHECK_ALL') ?>"
						       onclick="Joomla.checkAll(this)"/>
					</th>
					<th class='left'>
						<?= HTMLHelper::_(
							'grid.sort',
							'User',
							'user',
							$listDirn,
							$listOrder
						) ?>
					</th>
					<th class='left'>
						<?= HTMLHelper::_(
							'grid.sort',
							'Email',
							'email',
							$listDirn,
							$listOrder
						) ?>
					</th>
					<th class='left'>
						<?= HTMLHelper::_(
							'grid.sort',
							'University',
							'university',
							$listDirn,
							$listOrder
						) ?>
					</th>
					<th class='left'>
						<?= HTMLHelper::_(
							'grid.sort',
							'Lifetime Member',
							'lifetime_member',
							$listDirn,
							$listOrder
						) ?>
					</th>
					<th width="1%" class="nowrap center hidden-phone">
						<?= HTMLHelper::_(
							'grid.sort',
							'JGRID_HEADING_ID',
							'id',
							$listDirn,
							$listOrder
						) ?>
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
					$ordering = ($listOrder == 'a.ordering');
					$canCreate = $user->authorise('core.create', 'com_swa');
					$canEdit = $user->authorise('core.edit', 'com_swa');
					$canCheckin = $user->authorise('core.manage', 'com_swa');
					$canChange = $user->authorise('core.edit.state', 'com_swa');
					?>
					<tr class="row<?= $i % 2 ?>">

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
										$disabledLabel    = Text::_('JORDERINGDISABLED');
										$disableClassName = 'inactive tip-top';
									endif; ?>
									<span class="sortable-handler hasTooltip <?= $disableClassName ?>"
									      title="<?= $disabledLabel ?>">
							                <i class="icon-menu"></i>
                                    </span>
									<input type="text" style="display:none" name="order[]" size="5"
									       value="<?= $item->ordering ?>"
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
							<?= HTMLHelper::_('grid.id', $i, $item->id) ?>
						</td>
						<td>
							<?php if ($canEdit)
								:
								?>
								<?php $baseURL = 'index.php?option=com_swa&task=member.edit&id='; ?>
								<a href="<?= Route::_( $baseURL . (int) $item->id) ?>">
									<?= $item->user ?>
								</a>
							<?php else
								:
								?>
								<?= $item->user ?>
							<?php endif; ?>
						</td>
						<td>
							<?= $item->email ?>
						</td>
						<td>
							<?= $item->university ?>
						</td>
						<td>
							<?= $item->lifetime_member ?>
						</td>
						<td class="center hidden-phone">
							<?= (int) $item->id ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<input type="hidden" name="task" value=""/>
			<input type="hidden" name="boxchecked" value="0"/>
			<input type="hidden" name="filter_order" value="<?= $listOrder ?>"/>
			<input type="hidden" name="filter_order_Dir" value="<?= $listDirn ?>"/>
			<?= HTMLHelper::_('form.token') ?>
		</div>
</form>
