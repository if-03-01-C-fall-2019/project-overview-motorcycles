<?php

    $errorMessage = "";

    if(array_key_exists("submit", $_POST)){

        $username = $_POST['username'];
        $passwort = $_POST['passwort'];

        $statement = "SELECT * FROM users WHERE username = '".mysqli_real_escape_string($conn, $username)."'";
        $result = mysqli_query($conn, $statement);
        $row = mysqli_fetch_array($result);


        if($row['username'] != $username){
            $errorMessage = "<p>Minecraft-Benutzername wurde nicht registriert!</p><br>";
        }
        else {
            if(isset($row)){
                //Überprüfung des Passworts
                $hash = password_hash($_POST['passwort'], PASSWORD_DEFAULT);
                if (password_verify($passwort, $hash)) {
                    /*if($row['rank'] != 'Owner'){
                        $_SESSION['userid'] = $row['id'];
                        header('Location: bewerben/index');
                    }
                    else{
                        header('Location: adminpage/index');
                    }*/
                } else {
                    $errorMessage = "<p>Minecraft-Benutzername oder Passwort war ungültig</p><br>";
                }
            }else{
                $errorMessage = "<p>Minecraft-Benutzername oder Passwort war ungültig</p><br>";
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/login.css">

        <meta charset="utf-8">
        <title>Motorbike</title>
    </head>



    <body>

        <div class="container text-center">
            <?php
            if(isset($errorMessage)) {
                echo $errorMessage;
            }
            ?>
            <form action="?register=1" method="post">
                <div id="form">
                    Minecraft-Benutzername<br>
                    <input type="text" size="40" maxlength="250" name="username"><br><br>

                    Dein Passwort:<br>
                    <input type="password" size="40"  maxlength="250" name="passwort"><br><br>

                    <input type="submit" class="btn btn-success" value="Login" name="submit">
                </div>
            </form>
        </div>



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>

</html>