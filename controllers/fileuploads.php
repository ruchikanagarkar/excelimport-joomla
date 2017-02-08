<?php
/**
 * @version    1.0.0
 * @author     Ruchika Nagarkar <ruchikanagarkar@outlook.com>
 * @copyright  2017 Ruchika Nagarkar
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

require_once(JPATH_COMPONENT_ADMINISTRATOR . '/assets/PHPExcel/Classes/PHPExcel.php');
require_once(JPATH_COMPONENT_ADMINISTRATOR . '/assets/PHPExcel/Classes/PHPExcel/IOFactory.php');

use Joomla\Utilities\ArrayHelper;

/**
 * Fileuploads list controller class.
 *
 * @since  1.6
 */
class ComponentnameControllerFileuploads extends JControllerAdmin
{

	/**
	 * Method to call Section upload function
	 * @param   array  $data  Form fields values
	 *
	 */
	public function sectionTask($data = array()){
		$section = explode(':', $_POST['section']);
		$year    = $_POST['year'];
		$data = array('section'=>$section, 'year'=>$year);

		switch ($section[0]) {
			case '1':
				$this->uploadData($_FILES,$data,'#__section1_tablename'); //change the table name as your requirement
				break;
			case '2':
				$this->uploadData($_FILES,$data,'#__section2_tablename');
				break;
			default:
				$this->setRedirect(JRoute::_('index.php?option=com_componentname&view=fileuploads', false), 'Invalid section selected','error');
				break;
		}
	}

	/**
	 * Method to upload data
	 * @param   array  $fileData  excel sheet values
	 * @param   array  $data  Form fields values
	 * @param   string  $tablename  table name of the section uploaded
	 *
	 */
	public function uploadData($fileData, $data,$tablename){
		//Validate file
		$isValid = $this->validateFileType($fileData);

		if($isValid){

			$inputFilename = $fileData['excelfile']['tmp_name'];
			try {
				$objPHPExcel    = PHPExcel_IOFactory::load($inputFilename); //read the spreadsheet workbook
			} catch (Exception $e) {
				die('Error loading file "'.pathinfo($inputFilename,PATHINFO_BASENAME).'": '.$e->getMessage());
			}

			//validate section/year of sheet to match as selected
			$isSame = $this->validateSection($data,$objPHPExcel);

			if($isSame){

				// check if sheet data has already been uploaded
				$isNotDuplicate = $this->validateDuplicate($data,$tablename);

				if($isNotDuplicate){
					//  Get worksheet dimensions
					$sheet = $objPHPExcel->getSheet(0);
					$highestRow = $sheet->getHighestRow();
					$highestColumn = $sheet->getHighestColumn();

					$getValues = array();

		           	for ($row = 4; $row <= $highestRow; $row++){
		           		//  Read a row of data into an array
		           		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row);
		           		if(!empty($rowData[0][0])){ //if row is null
		           			//  Insert row data array into database
		           			$getValues[] = $this->getValuesModel($rowData, $data);
		           		}

		           	}// excel for loop ends

		           	$columns = $this->getColumns($data); //call columns method to fetch different section's columns

					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
		           	$query->insert($db->quoteName($tablename));
					$query->columns($columns);
					$query->values($getValues);
					$db->setQuery($query);
					$isInserted = $db->query();

		           	if($isInserted){
						//redirect after importing the data from excel into database
						$this->setRedirect(JRoute::_('index.php?option=com_componentname&view=fileuploads', false), 'File uploaded successfully','message');
		           	}

				}//if($isDuplicate)

			} //$isSame

		}//if($isValid)
	}

	/**
	 * Validate method to check file type
	 * @param   array  $fileData  excel sheet values
	 *
	*/
	public function validateFileType($fileData){
		$mimes = array('application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(in_array($fileData['excelfile']['type'],$mimes)){
			return true;
		}
		else{
			$this->setRedirect(JRoute::_('index.php?option=com_componentname&view=fileuploads', false), 'Please select a valid file','error');
			return false;
		}
	}

	/**
	 * Validate method to check section/year matches the options selected
	 * @param   array  $data  section/year values
	 * @param   object  $objPHPExcel  phpexcel object
	 *
	*/
	public function validateSection($data, $objPHPExcel){
		$sheetTitle = $objPHPExcel->getActiveSheet()->getCell('A1'); //get sheet section name/year - 2009 Section1
		if(strpos( strtoupper($sheetTitle),$data['section'][1] )!==false && strpos($sheetTitle,$data['year'])!==false ){
			return true;
		}
		else{
			$this->setRedirect(JRoute::_('index.php?option=com_componentname&view=fileuploads', false), 'Selected section/year does not match the sheet uploaded.' ,'error');
			return false;
		}
	}

	/**
	 * Validate method to check duplicate data
	 * @param   array  $data  section/year values
	 * @param   string  $tablename  table name of section
	 *
	*/
	public function validateDuplicate($data,$tablename){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id')->from($tablename)
			  ->where('section_id = "'.$data['section'][0].'"')
			  ->where('year = "'.$data['year'].'"');
		$db->setQuery($query);
		$db->execute();
		$rowsCount = $db->getNumRows();

		if($rowsCount <= 0 ){
			return true;
		}
		else{
			$this->setRedirect(JRoute::_('index.php?option=com_componentname&view=fileuploads', false), 'Data has been already uploaded. Kindly, delete the data first and then upload' ,'error');
			return false;
		}
	}


    /**
	 * Get columns method for different section
	 * @param   array  $data  section/year values
	*/
	public function getColumns($data){
		$columns = '';
		//section1 columns
		if($data['section'][0] == 1){
			$columns = array(
					  'section1_id', 'category1', 'subcategory1', 'year1', 'indicator1', 'number_type1',
					  'decimal_point_value1', 'decimal_point_zone1', 'total_count_male_female1', 'gender_male1'
			    );
		}
		//section2 columns are different from section1 columns as in the excel sheet
		elseif($data['section'][0] == 2){
			$columns = array(
					  'section2_id', 'category2', 'subcategory2', 'year2', 'indicator2', 'number_type2',
					  'decimal_point_value2', 'decimal_point_zone2', 'total_count_male_female2', 'gender_male2'
			    );
		}
		else{
			$columns = 0;
		}

		return $columns;
	}

	/**
	 * Call models for different section
	 * @param   array  $rowData  excel values
	 * @param   array  $data  section/year values
	*/
	public function getValuesModel($rowData, $data){
		$model = JModelLegacy::getInstance('Fileupload','ComponentnameModel');
		$modelOutput = '';

		if($data['section'][0] == 1){
			$modelOutput = $model->getValuesSection1($rowData,$data);
		}
		elseif($data['section'][0] == 2){
			$modelOutput = $model->getValuesSection2$rowData,$data);
		}
		else{
			$modelOutput = 0;
		}

		return $modelOutput;
	}


}
