<?php

    include 'db.php';
    $conn = getDB("finalMovies");

    $sql = "DELETE FROM movieInfo
            WHERE movieName = :movieName";
    $namedParameters = array();
    $namedParameters[':movieName'] = $_POST['name'];
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);

    if( !headers_sent() ){
      header("Location: ../deleterecords.php");
    }else{
      ?>
      <script type="text/javascript">
      document.location.href="../deleterecords.php";
      </script>
      Redirecting to <a href="../deleterecords.php">The Delete Page..</a>
      <?php
    }
    die();

    echo "Movie Deleted!";
?>
