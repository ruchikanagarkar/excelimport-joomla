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

		$values = ' "'.$data['section'][0].'" , "'.str_replace("'","",$rowData[0][0]).'" ,"'.str_replace("'","",$rowData[0][6]).'" , "'.$data['year'].'" ,"'.str_replace("'","",$rowData[0][7]).'", "'.$rowData[0][8].'" , "'.$rowData[0][9].'" ,"'.$rowData[0][10].'" , "'.$rowData[0][11].'" , "'.$rowData[0][12].'" ,"'.$rowData[0][13].'" , "'.$rowData[0][14].'" , "'.$rowData[0][15].'" ,"'.$rowData[0][16].'" , "'.$rowData[0][17].'" , "'.$rowData[0][18].'" ,"'.$rowData[0][19].'" , "'.$rowData[0][20].'" , "'.$rowData[0][21].'" ,"'.$rowData[0][22].'" , "'.$rowData[0][23].'" , "'.$rowData[0][24].'" ,"'.$rowData[0][25].'" , "'.$rowData[0][26].'" , "'.$rowData[0][27].'" ,"'.$rowData[0][28].'" , "'.$rowData[0][29].'" , "'.$rowData[0][30].'" ,"'.$rowData[0][31].'" , "'.$rowData[0][32].'" , "'.$rowData[0][33].'" ,"'.$rowData[0][34].'" , "'.$rowData[0][35].'" , "'.$rowData[0][36].'" ,"'.$rowData[0][37].'" , "'.$rowData[0][38].'" , "'.$rowData[0][39].'" ,"'.$rowData[0][40].'" , "'.$rowData[0][41].'" , "'.$rowData[0][42].'" ,"'.$rowData[0][43].'" , "'.$rowData[0][44].'" , "'.$rowData[0][45].'" ';

	 	return $values;
	}

	/**
	 * Insert method for Section2 section
	 * @param   array  $rowData  excel values
	 * @param   array  $data  section/year values
	*/
	public function getValuesSection2($rowData, $data){
		$values = ' "'.$data['section'][0].'" , "'.str_replace("'","",$rowData[0][0]).'" ,"'.str_replace("'","",$rowData[0][6]).'" , "'.$data['year'].'" ,"'.str_replace("'","",$rowData[0][7]).'", "'.$rowData[0][8].'" , "'.$rowData[0][9].'" ,"'.$rowData[0][10].'" , "'.$rowData[0][11].'" , "'.$rowData[0][12].'" ,"'.$rowData[0][13].'" , "'.$rowData[0][14].'" , "'.$rowData[0][15].'" ,"'.$rowData[0][16].'" , "'.$rowData[0][17].'" , "'.$rowData[0][18].'" ,"'.$rowData[0][19].'" , "'.$rowData[0][20].'" , "'.$rowData[0][21].'" ,"'.$rowData[0][22].'" , "'.$rowData[0][23].'" , "'.$rowData[0][24].'" ,"'.$rowData[0][25].'" , "'.$rowData[0][26].'" , "'.$rowData[0][27].'" ,"'.$rowData[0][28].'" , "'.$rowData[0][29].'" , "'.$rowData[0][30].'" ,"'.$rowData[0][31].'" , "'.$rowData[0][32].'" , "'.$rowData[0][33].'" ,"'.$rowData[0][34].'" , "'.$rowData[0][35].'" , "'.$rowData[0][36].'" ,"'.$rowData[0][37].'" , "'.$rowData[0][38].'" , "'.$rowData[0][39].'" ,"'.$rowData[0][40].'" , "'.$rowData[0][41].'" , "'.$rowData[0][42].'" ,"'.$rowData[0][43].'" , "'.$rowData[0][44].'" , "'.$rowData[0][45].'" ';

	 	return $values;
	}

}
