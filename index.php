<!-- index page -->

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login Page</title>
      <style>
         html{
         height: 100%;
         }
         body {
         margin: 0;
         padding: 0;
         font-family: 'Arial', sans-serif;
         background: linear-gradient(#00050f, #001731);	
         max-width:max-content;
         max-height: max-content;
         }
         .login-box {
         position: absolute;
         top: 50%;
         left: 50%;
         width: 400px;
         padding: 40px;
         transform: translate(-50%, -50%);
         background: rgba(0,0,0,.5);
         box-sizing: border-box;
         box-shadow: 0 15px 25px rgba(0,0,0,.6);
         border-radius: 10px;
         }
         .login-box h2 {
         margin: 0 0 30px;
         padding: 0;
         color: #F1EEE6;
         text-align: center;
         }
         .login-box .user-box {
         position: relative;
         }
         .login-box .user-box input {
         width: 80%;
         padding: 10px 0;
         font-size: 16px;
         color: #F1EEE6;
         margin-bottom: 30px;
         margin-left:35px ;
         border: none;
         border-bottom: 1px solid #F1EEE6;
         outline: none;
         background: transparent;
         }
         .login-box .user-box label {
         position: absolute;
         top: 0;
         left: 0;
         padding: 10px 0;
         margin-left:35px ;
         font-size: 16px;
         font-weight:bold;
         color: #F1EEE6;
         pointer-events: none;
         transition: .5s;
         }
         .login-box .user-box input:focus ~ label, .login-box .user-box input:valid ~ label {
         top: -20px; 
         left: 0px; 
         color: #03E9F4;
         font-size: 12px;
         }
         .login-box form .submit-button {
         position: relative;
         display: inline-block;
         padding: 10px 20px;
         color: #03E9F4;
         font-size: 16px;
         text-decoration: none;
         text-transform: uppercase;
         overflow: hidden;
         transition: .5s;
         margin-top: 40px;
         letter-spacing: 4px;
         background: transparent;
         border: none;
         cursor: pointer;
         margin-left:100px ;
         }
         .login-box form .submit-button:hover {
         background: #03E9F4;
         color: #F1EEE6;
         border-radius: 5px;
         box-shadow: 0 0 5px #03E9F4, 0 0 10px #03E9F4, 0 0 5px #03E9F4, 0 0 0px #03E9F4;
         }
         .login-box form .submit-button span {
         position: absolute;
         display: block;
         background: #03E9F4;  /* Add a background color for visibility */
         }
         .login-box form .submit-button span:nth-child(1) {
         top: 0;
         left: -100%;
         width: 100%;
         height: 2px;
         animation: btn-anim 1s linear infinite;
         }
         @keyframes btn-anim {
         0% {
         left: -100%;
         }
         50%, 100% {
         left: 100%;
         }
         }
         /* Similar styles for other span elements */
      </style>
   </head>
   <body>
      <div class="login-box">
         <h2>VEHICLE MAINTENANCE LOG</h2>
         <br>
         <form id="loginForm" onsubmit="return validateLogin()">
            <div class="user-box">
               <input type="text" id="username" name="username" required>
               <label for="username">Username</label>
            </div>
            <div class="user-box">
               <input type="password" id="password" name="password" required>
               <label for="password">Password</label>
            </div>
            <button type="submit" class="submit-button">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Submit
            </button>
         </form>
      </div>
      <script>
         function validateLogin() {
             var usernameInput = document.getElementById('username');
             var passwordInput = document.getElementById('password');
         
             // Validate against default username and password
             if (usernameInput.value === "admin" && passwordInput.value === "sam") {
                 // Successful login, redirect to index2.php
                 window.location.href = "index2.php";
                 return false; // Prevent form submission (optional)
             } else {
                 // Invalid login
                 alert("Invalid username or password.");
                 return false;
             }
         }
      </script>
   </body>
</html>