<?php
  function flag($arr, $user){
    $totalAppearance = 0;
    foreach ($arr as $ar) {
      if($user == $ar){
        $totalAppearance++;
      }
    }
    return $totalAppearance;
  }
?>

<script>
  consol.log("Hi there");
</script>