<?php
  function extract_first_name($name)
  {
      $name=explode(' ',$name);
      return $name[0];
  }
?>