
<?php
include "top.php";
    if(isset($_SESSION['username'])){
        session_unset();
        session_destroy();
    }
    ?>


    <form id="loginform" action="login.php" method="post" >  <!--  -->
    <div class="container">
        <label for="uname">Username</label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw">Password</label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button id="login" type="submit">Login</button> <!--  -->
    </div>
    </form>

    <form>
        <div class="container">
        <button id="register" type="button" class="register">Non hai un account? Registrati QUI</button>
        </div>
    </form>

<?php include "../HTML/bottom.html";?>