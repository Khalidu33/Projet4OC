<!-- Message de bienvenue -->
<?php
if (isset($_SESSION) && !empty($_SESSION))
{
    echo "<p class=\"session\">Bonjour " . $_SESSION['pseudo'] . " </p>";
}
?>