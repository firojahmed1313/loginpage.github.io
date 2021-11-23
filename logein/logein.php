<?php
    $loginAlart=false;
    $showError=false;

    if ($_SERVER["REQUEST_METHOD"] =="POST")
    {
        include './partial/_dbconnect.php' ;

        $email=$_POST["email"];
        $password=$_POST["password"];

        $exists=false;

        //$sql="Select * from id_test where email='$email' AND password='$password'";

        $sql="Select * from id_test where email='$email' ";
        $result=mysqli_query($conn,$sql);


        $num=mysqli_num_rows($result);
        if ($num==1) {
            while ($row=mysqli_fetch_assoc($result)) {
                if (password_verify($password,$row['password'])) {
                    $loginAlart=true;
                    session_start();
                    $_SESSION['loggedin']= true;
                    $_SESSION['username']=$email;
                    header("location: welcome.php"); 
                }
                else {
                    $showError="invalid email or password";
        
                }
                
            }
            


        }
        else {
            $showError="invalid email or password";

        }
            

        
       
    }


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>LogIn Page</title>
</head>

<body>
    <?php require './partial/_nav.php';
    if($loginAlart){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success!</strong> Your login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
    if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }


    ?>
    <div class="container my-4">
        <h2 class="text-center">LogIn To Our Website</h2>
        <form action="/firoj/logein/logein.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            
            <button type="submit" class="btn btn-primary">LogIn</button>
        </form>
    </div>















    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>