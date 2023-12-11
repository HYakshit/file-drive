<?php
require_once("../../database/CountryClass.php");
//state id will be set only when user edit country is
$obj = new State();
if (isset($_GET['country_id'])) {
   $id = $_GET['country_id'];
   if(isset($_GET['stateId'])){
      $stateId = $_GET['stateId'];
      // echo''.$id.''.$stateId.'';
   }
      $state = $obj->selectedStates($id);
      $optionlist = "<option value='null'>Select State</option>";
      foreach ($state as $index => $row)
         if (isset($_GET['stateId']) && $row['state_id'] == $stateId) {
            $optionlist .= "<option selected value=" . $row['state_id'] . "> " . $row['state_name'] . "</option>";
         }else{
            $optionlist .= "<option value=" . $row['state_id'] . "> " . $row['state_name'] . "</option>";
         }
      echo $optionlist;
}
?>