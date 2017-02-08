<?php
/**
 * @version    1.0.0
 * @package    Com_Componentname
 * @author     Ruchika Nagarkar <ruchikanagarkar@outlook.com>
 * @copyright  2017 Ruchika Nagarkar
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access.
defined('_JEXEC') or die;


jimport('joomla.application.component.modeladmin');

/**
 * Componentname model.
 *
 * @since  1.6
 */
class ComponentnameModelFileupload extends JModelAdmin
{

	/**
	 * Insert method for Section1 section
	 * @param   array  $rowData  excel values
	 * @param   array  $data  section/year values
	*/
	public function getValuesSection1($rowData, $data){

		$values = ' "'.$data['section'][0].'" , "'.str_replace("'","",$rowData[0][0]).'" ,"'.str_replace("'","",$rowData[0][6]).'" , "'.$data['year'].'" ,"'.str_replace("'","",$rowData[0][7]).'", "'.$rowData[0][8].'" , "'.$rowData[0][9].'" ,"'.$rowData[0][10].'" , "'.$rowData[0][11].'" , "'.$rowData[0][12].'" ';

	 	return $values;
	}

	/**
	 * Insert method for Section2 section
	 * @param   array  $rowData  excel values
	 * @param   array  $data  section/year values
	*/
	public function getValuesSection2($rowData, $data){
		$values = ' "'.$data['section'][0].'" , "'.str_replace("'","",$rowData[0][0]).'" ,"'.str_replace("'","",$rowData[0][6]).'" , "'.$data['year'].'" ,"'.str_replace("'","",$rowData[0][7]).'", "'.$rowData[0][8].'" , "'.$rowData[0][9].'" ,"'.$rowData[0][10].'" , "'.$rowData[0][11].'" , "'.$rowData[0][12].'" ';

	 	return $values;
	}

}
