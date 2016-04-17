<?php
/**
 * Get a list
 * 
 * @package cmp
 * @subpackage processors
 * This file needs to be customized
 */
/* setup default properties */
$showSelect = true;
require_once 'getlist.php';

$count = 1;
$list = array();
if ( isset($showSelect) && $showSelect ){
    $list[] = array('id'=> 0, 'name' => 'Show all');
    $count++;
}
return $this->outputArray($list,$count);