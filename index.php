<?php
  session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <h1>Hello, world!</h1>
  <?php if (isset($_SESSION['user'])) : ?>
    <div class="logout-form-wrapper">
      <form action="logout.php" method="post">
        <div class="form__field">
          <input type="submit" value="Logout" class="btn btn--primary">
        </div>
      </form>
    </div>
  <?php endif; ?>
  <!--     buddyRegistration -->

  <section class="buddyRegistration">
            <div class="phpBuddyLogin phpBuddyLogin--register">
            <div class="form form--login">
              <form action="" method="post">
                <h2 form__title>Sign up for an account</h2>
                    <?php if( isset($error) ): ?>
                      <div class="form__error">
                        <p>
                          <?php echo $error; ?>
                        </p>
                      </div>
                    <?php endif; ?>

                    <div class="form__field">
                      <label for="firstname">Firstname</label>
                      <input type="text" id="firstname" name="firstname">
                    </div>	
                    
                    <div class="form__field">
                      <label for="lastname">Lastname</label>
                      <input type="text" id="lastname" name="lastname">
                    </div>

                    <div class="form__field">
                      <label for="email">Email</label>
                      <input type="text" id="email" name="email" placeholder="r123456@student.thomasmore.be">
                    </div>

                    <div class="form__field">
                      <label for="password">Password</label>
                      <input type="password" id="password" name="password">
                    </div>

                    <div class="form__field">
                      <label for="password_confirmation">Confirm your password</label>
                      <input type="password" id="password_confirmation" name="password_confirmation">
                    </div>

                    <div class="form__field">
                      <input type="submit" value="Sign me up!" class="btn btn--primary">	
                    </div>
               </form>
              </div>
            </div>
        </section>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>