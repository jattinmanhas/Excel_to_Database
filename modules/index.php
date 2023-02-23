<?php
/**
 * Example Application
 *
 * @package Example-application
 */
require '../libs/Smarty.class.php';
require './classes.php';
$smarty = new Smarty;
//$smarty->force_compile = true;

$database = new Database();

$data = $database -> read();

// if (isset($_GET['msg']) && !empty($_GET['msg'])) {
//   // Print the value of the "name" parameter
//   echo "<h4 style='text-align:center; color: red'>".$_GET['msg']."!</h4>";
// }

if(isset($_POST['download_file_btn'])){
  $database -> download_data();
}

if(isset($_POST['import_file_btn'])){
    $database -> insert_data();
}

if(isset($_POST['delete_file_btn'])){
    $database -> delete_data();
}

$smarty->assign('data', $data);

$smarty->display('../Smarty_excel/templates/index.tpl');
