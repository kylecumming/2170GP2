<!-- Added ability to log out of session: Keaton Gibb B00833276
This really helped me know how to use $_POST better and $_SESSION which helped me with my individual assignments-->

<?php
session_start();
if (session_destroy()) {
    $_SESSION['loggedin'] = false;
    header("Location: ../login.php");
}
