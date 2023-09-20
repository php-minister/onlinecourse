<?php
  function result_array($data)
  {
     $result=array();
     while($row=mysql_fetch_assoc($data->result_id))
     {
         $result[$row['id']]=$row;
     }
     
     return $result;
  }
?>