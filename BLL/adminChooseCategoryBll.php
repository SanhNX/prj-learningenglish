<?php
include '../DAO/connection.php';
include '../DTO/object.php';
include '../BLL/categoryBll.php';

$flag = $_POST['flag'];
$chooseValue = $_POST['chooseValue'];
$categoryList = null;
$optionList = '';
if($flag == 'chooseCate'){
    if($chooseValue == 'E'){
        $categoryList = getAllCategoryForEveryone();
    } else {
        $categoryList = getAllCategoryForKids();
    }
    for ($i = 0; $i < count($categoryList); $i++) {
        $item = $categoryList[$i];
        $optionList = $optionList . '<option value="'. $item->id .'">'. $item->name .'</option>';
    }
    echo $optionList;
}
?>