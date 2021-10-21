<?php
    if(isset($_POST['results'])){
        header('location: results.php');
        
    }

    if(isset($_POST['survey'])){
        header('location: survey.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--responsive meta tags-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Mandla'ke Makondo's Survey | HOME</title>
        <!--font Awesome cdn-->
        <script src="https://use.fontawesome.com/11a6022eb7.js"></script>

        <!--css script-->
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <div class="container">
            <h1>Human Behaviour Survey</h1>
            <div class="content">
                <div class="myForm">
                    <form action="" method="post">
                        <input type="submit" value="Survey" name="survey">
                        <input type="submit" value="Results" name="results">
                    </form>
                </div>                
            </div>
          </div>

    </body>
</html>