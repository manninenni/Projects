<?php

if (empty($_POST)) {
    header('location: index.php');
} else {
    require 'database.php';

    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    if (empty($password) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM kayttajatunnukset WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror&select-statement");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($password, $row['salasana']);
                if ($passCheck == false) {
                    header("Location: ../index.php?error=wrongpass");
                    exit();
                } elseif ($passCheck == true) {
                    $_SESSION['userID'] = $row['kayttajatunnusID'];
                    $_SESSION['priviledge'] = $row['admin'];
                    header("Location: ../index.php?success=loggedin");
                    exit();
                } else {
                    header("Location: ../index.php?error=wrongpass");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }           
    }
}
?>