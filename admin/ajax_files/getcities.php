<?php
require_once("../../database/CountryClass.php");
$obj = new City();
if (isset($_GET['selected'])) {
   $selected = $_GET['selected'];
   $city = $obj->selectedCities($selected);
   if (isset($_GET['cityId'])) {
      $cityId = $_GET['cityId'];
   }
   // echo"<pre>";
   // print_r($city);
   // exit();
   $optionlist = "<option value='null'>Select City</option>";
   foreach ($city as $index => $row) {
      if (isset($_GET['cityId']) && $row['city_id'] == $cityId) {
         $optionlist .= "<option selected value=" . $row['city_id'] . "> " . $row['city_name'] . "</option>";
      } else {
         $optionlist .= "<option value=" . $row['city_id'] . " > " . $row['city_name'] . "</option>";
      }
   }
   echo $optionlist;
}