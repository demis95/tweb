<html>
<!--
Autore:     Demis Mazzotta
Corso:      B
-->
<?php include "top.html"; ?>
    <body>
        <form action ="matches-submit.php" method="GET">
            <fieldset>
                <legend>Returning User:</legend>
                    <label class="left"><strong>Name:</strong></label>
                    <input  class="column" type="text" size="16" name="name">
                    <br>
                    <br>
                    <label><input type="submit" value ="View My Matches"></label>
            </fieldset>
        </form>
    </body>
<?php include "bottom.html"; ?>
</html>


