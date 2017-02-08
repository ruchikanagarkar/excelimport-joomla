<?php
/**
 * @version    1.0.0
 * @package    Com_Componentname
 * @author     Ruchika Nagarkar <ruchikanagarkar@outlook.com>
 * @copyright  2017 Ruchika Nagarkar
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');

$default = '';
//dropdown list for section field
$options[] = JHTML::_('select.option','',JText::_('Please select Section'));
foreach($this->items as $value) :
		$options[] = JHTML::_('select.option', $value->id.':'.$value->name, $value->name);
endforeach;

?>

<script type="text/javascript">
function submitvalidate() {
    var adminForm = document.adminForm;
    if (document.formvalidator.isValid(adminForm)) {
        document.adminForm.submit();
        return true;
    }
    else {
        var msg = new Array();
        msg.push('<b>Error:</b>');
        if(jQuery('#section').hasClass('invalid')){
            msg.push('<?php echo JText::_('Please select a section!')?>');
        }
        if(jQuery('#excelfile').hasClass('invalid')){
            msg.push('<?php echo JText::_('Please verify that you have uploaded a csv/excel file!')?>');
        }
        document.getElementById('system-message-container').innerHTML = '<div class="alert alert-error"><button type="button" data-dismiss="alert" class="close">×</button><div>'+msg.join('\n')+'</div></div>';
        return false;
    }
}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_componentname&view=fileuploads'); ?>" class="form-validate" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
	<?php if (!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
		<div id="j-main-container">
			<?php endif; ?>

			<legend>Upload Excel Data For Different Sections</legend>
				<div class="control-group">
					<div class="control-label">
						<h4><?php echo JText::_('Select Section'); ?></h4>
					</div>
					<div class="controls">
						<?php echo JHTML::_('select.genericlist', $options, 'section', 'class="required"', 'value', 'text'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<h4><?php echo JText::_('Select Year'); ?></h4>
					</div>
					<div class="controls">
						<?php echo $year = JHTML::_('select.integerlist', 2009, 2016, 1, 'year', $default); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<h4><?php echo JText::_('Choose excel sheet'); ?> <small class="text-error">* Only excel sheets are allowed</small></h4>
					</div>
					<div class="controls">
						<input type="file" id="excelfile" name="excelfile" class="required" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
					</div>
				</div>
				<p>&nbsp;</p>
				<div class="control-group">
					<div class="control-label">
					</div>
					<div class="controls">
						<button class="btn btn-primary" onclick="submitvalidate()" type="submit" >Upload</button>
					</div>
				</div>


			<div class="clearfix"></div>

			<input type="hidden" name="task" value="fileuploads.sectionTask"/>
			<?php echo JHtml::_('form.token'); ?>
		</div>
</form>
