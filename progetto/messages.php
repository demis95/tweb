<?php

#creo un sistema di messaggi per rendere gli avvisi piu "friendly"

session_start();

$messages = $_SESSION['messages'];
unset($_SESSION['messages']);
?>
<ul>
    <?php foreach ($messages as $message): ?>
        <li><?php echo $message;?></li>
    <?php endforeach;?>
</ul>
