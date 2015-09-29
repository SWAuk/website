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
$saveOrder = $listOrder == 'a.ordering';
if ( $saveOrder ) {
	$saveOrderingUrl = 'index.php?option=com_swa&task=eventtickets.saveOrderAjax&tmpl=component';
	JHtml::_( 'sortablelist.sortable', 'eventticketList', 'adminForm', strtolower( $listDirn ), $saveOrderingUrl );
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
//Joomla Component Creator code to allow adding non select list filters
if ( !empty( $this->extra_sidebar ) ) {
	$this->sidebar .= $this->extra_sidebar;
}
?>

<form action="<?php echo JRoute::_( 'index.php?option=com_swa&view=eventtickets' ); ?>" method="post" name="adminForm" id="adminForm">
	<?php if (!empty( $this->sidebar )): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
		<div id="j-main-container">
			<?php endif; ?>
			<div id="adminview-description" >
				<p>Here you can see, add and edit tickets for specific events that can be bought by members.</p>
				<ul>
					<li>Quantity: The total number of this ticket availible.</li>
					<li>Needs SWA: Member needs to be on the 'Org Committee' to buy this ticket.</li>
					<li>Needs XSWA: Member needs to be marked as a graduate of a unit to buy this ticket.</li>
					<li>Needs Host: Member needs to be from one of the host universities to buy this ticket.</li>
					<li>Needs Qualification: Member needs to have a registered qualification to buy this ticket.</li>
				</ul>
			</div>
			<div id="filter-bar" class="btn-toolbar">
				<div class="filter-search btn-group pull-left">
					<label for="filter_search" class="element-invisible"><?php echo JText::_( 'JSEARCH_FILTER' ); ?></label>
					<input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_( 'JSEARCH_FILTER' ); ?>" value="<?php echo $this->escape( $this->state->get( 'filter.search' ) ); ?>" title="<?php echo JText::_( 'JSEARCH_FILTER' ); ?>"/>
				</div>
				<div class="btn-group pull-left">
					<button class="btn hasTooltip" type="submit" title="<?php echo JText::_( 'JSEARCH_FILTER_SUBMIT' ); ?>">
						<i class="icon-search"></i></button>
					<button class="btn hasTooltip" type="button" title="<?php echo JText::_( 'JSEARCH_FILTER_CLEAR' ); ?>" onclick="document.id('filter_search').value='';this.form.submit();">
						<i class="icon-remove"></i></button>
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="limit" class="element-invisible"><?php echo JText::_( 'JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC' ); ?></label>
					<?php echo $this->pagination->getLimitBox(); ?>
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="directionTable" class="element-invisible"><?php echo JText::_( 'JFIELD_ORDERING_DESC' ); ?></label>
					<select name="directionTable" id="directionTable" class="input-medium" onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_( 'JFIELD_ORDERING_DESC' ); ?></option>
						<option value="asc" <?php if ( $listDirn == 'asc' ) {
							echo 'selected="selected"';
						} ?>><?php echo JText::_( 'JGLOBAL_ORDER_ASCENDING' ); ?></option>
						<option value="desc" <?php if ( $listDirn == 'desc' ) {
							echo 'selected="selected"';
						} ?>><?php echo JText::_( 'JGLOBAL_ORDER_DESCENDING' ); ?></option>
					</select>
				</div>
				<div class="btn-group pull-right">
					<label for="sortTable" class="element-invisible"><?php echo JText::_( 'JGLOBAL_SORT_BY' ); ?></label>
					<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
						<option value=""><?php echo JText::_( 'JGLOBAL_SORT_BY' ); ?></option>
						<?php echo JHtml::_( 'select.options', $sortFields, 'value', 'text', $listOrder ); ?>
					</select>
				</div>
			</div>
			<div class="clearfix"></div>
			<table class="table table-striped" id="eventticketList">
				<thead>
				<tr>
					<?php if ( isset( $this->items[0]->ordering ) ): ?>
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo JHtml::_( 'grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING' ); ?>
						</th>
					<?php endif; ?>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_( 'JGLOBAL_CHECK_ALL' ); ?>" onclick="Joomla.checkAll(this)"/>
					</th>

					<th class='left'>
						<?php echo JHtml::_( 'grid.sort', 'Event', 'a.event', $listDirn, $listOrder ); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_( 'grid.sort', 'Name', 'a.name', $listDirn, $listOrder ); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_( 'grid.sort', 'Quantity', 'a.quantity', $listDirn, $listOrder ); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_( 'grid.sort', 'Price', 'a.price', $listDirn, $listOrder ); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_( 'grid.sort', 'Needs SWA', 'a.need_swa', $listDirn, $listOrder ); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_( 'grid.sort', 'Needs XSWA', 'a.need_xswa', $listDirn, $listOrder ); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_( 'grid.sort', 'Needs Host', 'a.need_host', $listDirn, $listOrder ); ?>
					</th>
					<th class='left'>
						<?php echo JHtml::_( 'grid.sort', 'Needs Qualification', 'a.need_qualification', $listDirn, $listOrder ); ?>
					</th>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHtml::_( 'grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder ); ?>
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

						<?php if ( isset( $this->items[0]->ordering ) ): ?>
							<td class="order nowrap center hidden-phone">
								<?php if ( $canChange ) :
									$disableClassName = '';
									$disabledLabel = '';
									if ( !$saveOrder ) :
										$disabledLabel = JText::_( 'JORDERINGDISABLED' );
										$disableClassName = 'inactive tip-top';
									endif; ?>
									<span class="sortable-handler hasTooltip <?php echo $disableClassName ?>" title="<?php echo $disabledLabel ?>">
							<i class="icon-menu"></i>
						</span>
									<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order "/>
								<?php else : ?>
									<span class="sortable-handler inactive">
							<i class="icon-menu"></i>
						</span>
								<?php endif; ?>
							</td>
						<?php endif; ?>
						<td class="center hidden-phone">
							<?php echo JHtml::_( 'grid.id', $i, $item->id ); ?>
						</td>
						<td>
							<?php echo $item->event; ?>
						</td>
						<td>
							<?php echo $item->name; ?>
						</td>
						<td>
							<?php echo $item->quantity; ?>
						</td>
						<td>
							<?php echo $item->price; ?>
						</td>
						<td>
							<?php echo $item->need_swa; ?>
						</td>
						<td>
							<?php echo $item->need_xswa; ?>
						</td>
						<td>
							<?php echo $item->need_host; ?>
						</td>
						<td>
							<?php echo $item->need_qualification; ?>
						</td>
						<td class="center hidden-phone">
							<?php echo (int)$item->id; ?>
						</td>
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

		
