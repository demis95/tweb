<html>
<!--
Autore:     Demis Mazzotta
Corso:      B
-->
<?php include "top.html"; ?>
<link rel="stylesheet" href="nerdluv.css">
    <body>
        <form action="signup-submit.php" method="POST">
            <fieldset>
                <legend>New User Signup:</legend>
                <ul>
                    <li>
                        <label ><strong>Name:</strong></label> 
                        <input type="text" size="16" maxlength="16" name="name">
                    </li>
    
                    <li>
                        <label><strong>Gender:</strong></label>
                        <input type="radio" name="gender" value="M"><label>male<label>
                        <input type="radio" name="gender" value="F" checked="checked"><label>Female<label>
                    </li>
                    
                    <li><label><strong>Age</strong></label>
                        <input type="text" size="6" maxlength="2" name="age">
                    </li>
                    
                    <li>
                        <label><strong>Personality type</strong></label> 
                        <input type="text" size="6" maxlength="4" name="personality">
                        (<a href="http://www.humanmetrics.com/cgi-win/jtypes2.asp">
                        Don't know your type?</a>)
                    </li>
                    
                    <li>
                        <label><strong>Favorite OS:</strong><label>
                        <select name="favoriteOS">
                            <option>Windows</option>
                            <option>Mac OS X</option>
                            <option selected="selected">Linux</option>
                        </select>
                    </li>
                    
                    <li>
                        <label><strong>Seeking age:</strong></label>
                        <input type="text" size="6" maxlength="2" placeholder="min" name="min">to
                        <input type="text" size="6" maxlength="2" placeholder="max" name="max">
                    </li>
                    
                    <li><label><input type="submit" value="Sign Up"></label></li>
                </ul>
            </fieldset>
        </form>
    </body>
<?php include "bottom.html"; ?>
</html>