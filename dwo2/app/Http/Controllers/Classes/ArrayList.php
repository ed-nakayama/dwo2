<?php

namespace App\Http\Controllers\Classes;

class ArrayList {

  var $list = Array();

  function add($element) { $this->list[] = $element; }
  function get($index)   { return $this->list[$index]; } 
  function size()   { return count($this->list); } 

}
?>