<?php

require '../mysql/database.php';


// Escape all $_POST variables to protect against SQL injections
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$name = test_input($_POST['name']);
$userID = test_input($_POST['user_id']);
$comment = test_input($_POST['comment']);

if (isset($name) && isset($comment)) {
  if (empty($name) || empty($comment)) {
    // $errorMsg = "fill are empty";
    header("location: ../blog-single.php?em1wdvpt45y=1");

  } else {
      $comment_length = strlen($comment);
      if ($comment_length > 100) {
        // $errorMsg = "Comment too long!";
        header("location: ../blog-single.php?to1wdvolon71g=2");

      } else {
        $sql = "INSERT INTO comments (UserID, FullName, Comment) VALUES('$userID', '$name', '$comment')";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        header("location: ../blog-single.php?su1wdvccesyhs=2");
    }
  }
}


 ?>
