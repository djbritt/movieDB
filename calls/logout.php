
<?php
session_start();
session_destroy();

if( !headers_sent() ){
  header("Location: ../index.php");
}else{
  ?>
  <script type="text/javascript">
  document.location.href="../index.php";
  </script>
  Redirecting to <a href="../index.php">The Homepage..</a>
  <?php
}
die();

?>
