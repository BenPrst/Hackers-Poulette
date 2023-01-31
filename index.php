<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Support Contact</title>
</head>

<body>
    <?php
    //define variables and set to empty values
    include 'db.php';

    $firstnameErr = $nameErr = $emailErr =  $commentErr = "";
    $firstname = $name = $email = $comment = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["firstname"])) {
            $firstnameErr = "Firstname is required";
        } else {
            $firstname = test_input($_POST["firstname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }


        if (empty($_POST["comment"])) {
            $commentErr = "Comment is required";
        } else {
            $comment = test_input($_POST["comment"]);
        }

        if ($firstnameErr == "" && $nameErr == "" && $emailErr == "" && $commentErr == "") {
            // Connect to database and insert data
            $sql = "INSERT INTO supportusers (firstname, name, email, comment)
            VALUES (:firstname, :name, :email, :comment)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':firstname', $firstname);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':comment', $comment);
            $stmt->execute();
            echo '<script>alert("La requête a été ajoutée avec succès !")</script>';
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>
    <h1>Contact Us</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="firstname">
            Firstname:
            <input type="text" name="firstname" id="firstname" minlength="3" maxlength="20">
            <span class="error">* <?php echo $firstnameErr; ?></span>
        </label>
        <br>
        <label for="name">
            Name:
            <input type="text" name="name" id="name" minlength="3" maxlength="20">
            <span class="error">* <?php echo $nameErr; ?></span>
        </label>
        <br>
        <label for="email">
            Email:
            <input type="text" name="email" id="email" maxlength="30">
            <span class="error">* <?php echo $emailErr; ?></span>
        </label>
        <br>
        <label for="comment">
            Comment:
            <input type="text" name="comment" id="comment" maxlength="255">
            <span class="error">* <?php echo $commentErr; ?></span>
        </label>
        <br>
        <label for="submit">
            <input type="submit" name="submit" id="submit">
        </label>
    </form>
</body>

</html>