<?php include('inc/header.php');
// So there are 2 ways to include php files into each other:
  // 'include' - which is the include function we see above which will include the file
  //             but if theres an error in finding it, it will simply show the error and 
  //             continue to render what it can.
  // 'require' - which is very similar to include but if there's an error finding the file
  //             to include it will error out the whole page and stop from rendering anything.
  // 'require_once' and 'include_once" - which will check to include or require and if its 
  //             there it won't try to require or include again.
  // Brad likes to simply use include. 
?>


<?php
  $name=$email=$body='';
  $name_err=$email_err=$body_err='';

  // Form submit
  if(isset($_POST['submit'])){
    // Validate name
    if(empty($_POST['name'])){
      $name_err = 'Name is required';
    }else{
      $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    // Validate email
    if(empty($_POST['email'])){
      $email_err = 'Email is required';
    }else{
      $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    }
    // Validate body
    if(empty($_POST['body'])){
      $body_err = 'Feedback is required';
    }else{
      $body = filter_input(INPUT_POST,'body',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if(empty($name_err) && empty($email_err) && empty($body_err)){
      // Add to the database
      $sql = "INSERT INTO feedback (name,email,body) VALUES ('$name','$email','$body')";
      if(mysqli_query($conn,$sql)){
        // Success
        header('Location: feedback.php');
      }else{
        // Error
        echo 'Error: ' . mysqli_error($conn);
      }
    }
  }



?>

<img src="/learning_php/phpCrash/feedback/img/logo.png" class="w-25 mb-3" alt="">
    <h2>Feedback</h2>
    <p class="lead text-center">Leave feedback for Traversy Media</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST' class="mt-4 w-75">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $name_err?'is-invalid':null; ?>" id="name" name="name" placeholder="Enter your name">
        <div class="invalid-feedback">
          <?php echo $name_err; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $email_err?'is-invalid':null; ?>" id="email" name="email" placeholder="Enter your email">
        <div class="invalid-feedback">
          <?php echo $email_err; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control <?php echo $body_err?'is-invalid':null; ?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
        <div class="invalid-feedback">
          <?php echo $body_err; ?>
        </div>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>

<?php include('inc/footer.php');?>

