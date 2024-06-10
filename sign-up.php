<?php
 
 require_once('classes/database.php');
 $con=new database();

 $error = "";
  if(isset($_POST["signup"])) {
    $username = $_POST['username'];
    $email= $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
   
    

    if($password==$confirm) {
        if ($con->signup($username,$email,$password)) {
            header('location:sign-in.php');
    }else{
        $error_message ="Username already exists.Please Choose
        a diffent username.";
    }
}

  }
 ?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Tooplate's Little Fashion - Sign Up Page</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
<style>
    
.invalid-feedback{
    display: none;
    width: 100%;
    margin-top: .25rem;
    font-size: .875em;
    color: red;
}
</style>


    </head>
    
    <body>

        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>

            <section class="sign-in-form section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 mx-auto col-12">

                            <h1 class="hero-title text-center mb-5">Sign Up</h1>

                          

                           
    
                            <div class="row">
                                <div class="col-lg-8 col-11 mx-auto">
                                    <form role="form" method="post">
                                    <div class="form-floating">
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                            <label for="username">Username</label>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter a valid email.</div>
                                            <div id="usernameFeedback" class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-floating my-4">
                                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>

                                            <label for="email">Email address</label>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter a valid email.</div>
                                            <div id="emailFeedback" class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-floating my-4">
                                            <input type="password" name="password" id="password" pattern="[0-9a-zA-Z]{4,10}" class="form-control" placeholder="Password" required>

                                            <label for="password">Password</label>
                                            
                                            <p class="text-center">* shall include 0-9 a-z A-Z in 4 to 10 characters</p>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter a valid password.</div>
                                        </div>

                                        <div class="form-floating">
                                            <input type="password" name="confirm" id="confirm" pattern="[0-9a-zA-Z]{4,10}" class="form-control" placeholder="Password" required>

                                            <label for="confirm">Password Confirmation</label>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please confirm your password.</div>
                                        </div>
                                        <?php if (!empty($error_message)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error_message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                                        <input type="submit" class="btn custom-btn form-control mt-4 mb-3" value="Create accout" name="signup">
                                        </input>

                                        <p class="text-center">Already have an account? Please <a href="sign-in.php">Sign In</a></p>

                                    </form>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </section>

        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-10 me-auto mb-4">
                        <h4 class="text-white mb-3"><a href="index.php">Little</a> Fashion</h4>
                        <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2022 <strong>Little Fashion</strong></p>
                        <br>
                        <p class="copyright-text">Designed by <a href="https://www.tooplate.com/" target="_blank">Tooplate</a></p>
                    </div>

                    <div class="col-lg-5 col-8">
                        <h5 class="text-white mb-3">Sitemap</h5>

                        <ul class="footer-menu d-flex flex-wrap">
                            <li class="footer-menu-item"><a href="about.php" class="footer-menu-link">About</a></li>

                            <li class="footer-menu-item"><a href="products.php" class="footer-menu-link">Products</a></li>

                            <li class="footer-menu-item"><a href="" class="footer-menu-link">Privacy policy</a></li>

                            <li class="footer-menu-item"><a href="faq.php" class="footer-menu-link">FAQs</a></li>

                            <li class="footer-menu-item"><a href="contact.php" class="footer-menu-link">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-4">
                        <h5 class="text-white mb-3">Social</h5>

                        <ul class="social-icon">

                            <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="social-icon-link bi-youtube"></a></li>
                            <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="social-icon-link bi-whatsapp"></a></li>

                            <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="social-icon-link bi-instagram"></a></li>

                            <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="social-icon-link bi-skype"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="/js/script.js"></script>
        <script>  form.addEventListener("submit", (event) => {
  // Prevent form submission if the current step is not valid
  if (!validateStep(currentStep)) {
    event.preventDefault();
    event.stopPropagation();
  }

  // Add the 'was-validated' class to the form for Bootstrap styling
  form.classList.add("was-validated");
}, false);

// Function to move to the next step
window.nextStep = () => {
  // Only proceed to the next step if the current step is valid
  if (validateStep(currentStep)) {
    steps[currentStep].classList.remove("form-step-active"); // Hide the current step
    currentStep++; // Increment the current step index
    steps[currentStep].classList.add("form-step-active"); // Show the next step
  }
};

// Function to move to the previous step
window.prevStep = () => {
  steps[currentStep].classList.remove("form-step-active"); // Hide the current step
  currentStep--; // Decrement the current step index
  steps[currentStep].classList.add("form-step-active"); // Show the previous step
};

// Function to validate all inputs in the current step
function validateStep(step) {
  let valid = true;
  // Select all input and select elements in the current step
  const stepInputs = steps[step].querySelectorAll("input, select");

  // Validate each input element
  stepInputs.forEach(input => {
    if (!validateInput(input)) {
      valid = false; // If any input is invalid, set valid to false
    }
  });

  return valid; // Return the overall validity of the step
}

  
      function validateInput(input) {
        if (input.name === 'password') {
          return validatePassword(input);
        } else if (input.name === 'confirmPassword') {
          return validateConfirmPassword(input);
        } else {
          if (input.checkValidity()) {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");
            return true;
          } else {
            input.classList.remove("is-valid");
            input.classList.add("is-invalid");
            return false;
          }
        }
      }
  
      function validatePassword(passwordInput) {
        const password = passwordInput.value;
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (regex.test(password)) {
          passwordInput.classList.remove("is-invalid");
          passwordInput.classList.add("is-valid");
          return true;
        } else {
          passwordInput.classList.remove("is-valid");
          passwordInput.classList.add("is-invalid");
          return false;
        }
      }
  
      function validateConfirmPassword(confirmPasswordInput) {
        const passwordInput = form.querySelector("input[name='password']");
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
      
        if (password === confirmPassword && password !== '') {
          confirmPasswordInput.classList.remove("is-invalid");
          confirmPasswordInput.classList.add("is-valid");
          return true;
        } else {
          confirmPasswordInput.classList.remove("is-valid");
          confirmPasswordInput.classList.add("is-invalid");
          return false;
        }
      }

       document.addEventListener("keydown", (event) => {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
    </body>
</html>
