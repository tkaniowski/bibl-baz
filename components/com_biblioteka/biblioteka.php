<?php
/**
 * @version		2012-03
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

define('JPATH_BASE', dirname(__FILE__));
define( 'DS', DIRECTORY_SEPARATOR );
require_once ( JPATH_BASE .DS.'components'.DS.'com_biblioteka'.DS.'config.php' );
require_once ( JPATH_BASE .DS.'components'.DS.'com_biblioteka'.DS.'bibl.class.php');
$action_type = array(2=>'search');
?>

<?php
$db = & JFactory::getDBO();

$action = 1;
if(isset($_GET['a'])) $action = (int)$_GET['a'];

$id=0;
if(isset($_GET['id'])) $id = (int)$_GET['id'];

$typ=1;
if(isset($_GET['typ'])) $typ = (int)$_GET['typ'];
$b = new biblioteka($typ,$db,$dane);
if($id>0){
  //$b = new biblioteka('ksiazki',$db,$dane);
  $b->id=$id;
  $b->filtrowanie = ' AND id='.$id;
  //$b->inicjujFiltr();
  $b->pobierzWyniki();
  echo $b->wyswietlSzczegoly();
  echo $b->wyswietlPodobne();
}
else if($action==2){
  echo $b->wyswietlFiltrWyszukiwania();
  $b->inicjujFiltr();
  echo $b->wyswietlWynikiWyszukiwania();

}
else{
  $b->inicjujFiltr();
  $b->pobierzWyniki();
//echo $b->wyswietlStronicowanie();
//echo $b->wyswietlGoreListy();

  echo $b->wyswietlListeMini();
  echo $b->wyswietlStronicowanie();
}
?>