<?php
session_start();

// connection to database
require_once "config.php";


//handling incoming data
 if(isset($_POST['submit'])){

    // define variables and set to null by default
    $sn = $fn = $cn = $d = $a = $otr = $mr = $tvr= $rr = '';    

    $sn = input($_POST["surname"]);
    $fn = input($_POST["fName"]);
    $cn = input($_POST["contactNum"]);
    $d = input($_POST["date"]);
    $a = input($_POST["age"]);
    $fv = implode(",",$_POST["favourite_food"]);
    $otr = input($_POST["outing_rating"]);
    $mr = input($_POST["movie_rating"]);
    $tvr = input($_POST["tv_rating"]);
    $rr = input($_POST["radio_rating"]);
    
    $stmt = $pdo->prepare('INSERT INTO 
    surveys(surname, first_name, contact_number, survey_date, age,favourites, outing_rating, movie_rating, tv_rating, radio_rating)
    VALUES (:sn, :fn, :cn, :d, :a, :fv, :otr, :mr, :tvr, :rr) ');

   if( $stmt->execute(array(
        ':sn' => $sn,
        ':fn' => $fn,
        ':cn' => $cn,
        ':d' => $d,
        ':a' => $a,
        ':fv' => $fv,
        ':otr' => $otr,
        ':mr' => $mr,
        ':tvr' => $tvr,
        ':rr' => $rr)
    )){
        $_SESSION['success'] = "survey added";
        header("location: index.php");
    }else{
    header("location: survey.php");
}

 }

 

 function input($data){
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
 
     return $data;
 }
 

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--responsive meta tags-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Mandla'ke Makondo's Survey | Survey</title>
        <!--font Awesome cdn-->
        <script src="https://use.fontawesome.com/11a6022eb7.js"></script>

        <!--css script-->
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        
        <div class="wrapper">
            <h1>Take our Survey</h1>
            <br><br><br>
            <div class="survey">
                <h2>Personal Details:</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                    <label for="surname">Surname</label>
                    <input type="text" placeholder="Enter your surname" name="surname" required>

                    <label for="fName">First Name</label>
                    <input type="text" placeholder="Enter first name" name="fName" required>

                    <label for="contactNum">Contact number</label>
                    <input type="number" placeholder="Enter Contact number" name="contactNum" required>

                    <label for="date">Date</label>
                    <input type="date" name="date" required>

                    <label for="age">Age</label>
                    <input type="number" placeholder="Enter Age" id="ageTxtBox" name="age"  required>
                    <p id="ageVal"></p>
                    <br>
                    <br>
                    <fieldset style="border: none;">
                        <legend>What is your favourite food? (You can choose more than 1 answer)</legend>
                        <input type="checkbox" name="favourite_food[]" value="pizza" id="pizza"> <label for="pizza">Pizza</label><br>
                        <input type="checkbox" name="favourite_food[]" value="pasta" id="pasta"> <label for="pasta">Pasta</label><br>
                        <input type="checkbox" name="favourite_food[]" value="pap&wors" id="p&w"> <label for="p&w">Pap and Wors</label><br>
                        <input type="checkbox" name="favourite_food[]" value="chcknStirFry" id="chknSF" > <label for="chknSF"> Chicken stir fry</label> <br>
                        <input type="checkbox" name="favourite_food[]" value="beefStirFry" id="bfSF"> <label for="bfSF">Beef stir fry</label><br>
                        <input type="checkbox" name="favourite_food[]" value="other" id="other"> <label for="other">Other</label><br>
                    </fieldset>
                   <br>
                   <br>
                   <table>
                    <label>On a scale of 1 to 5 indicate whether you strongly agree to strongly disagree</label>
                        <tr>
                            <th></th>
                            <th>Strongly Agree (1)</th>
                            <th>Agree (2)</th>
                            <th>Neutral (3)</th>
                            <th>Disagree (4)</th>
                            <th>Strongly disagree (5)</th>
                        </tr>
                        <tr>
                            <td>I like to eat out</td>
                            <td><input type="radio" name="outing_rating" value="1"></td>
                            <td><input type="radio" name="outing_rating" value="2"></td>
                            <td><input type="radio" name="outing_rating" value="3"></td>
                            <td><input type="radio" name="outing_rating" value="4"></td>
                            <td><input type="radio" name="outing_rating" value="5"></td>
                        </tr >

                        <tr>
                            <td>I like to watch movies</td>
                            <td><input type="radio" name="movie_rating" value="1"></td>
                            <td><input type="radio" name="movie_rating" value="2"></td>
                            <td><input type="radio" name="movie_rating" value="3"></td>
                            <td><input type="radio" name="movie_rating" value="4"></td>
                            <td><input type="radio" name="movie_rating" value="5"></td>
                        </tr>

                        <tr>
                            <td>I like to watch TV</td>
                            <td><input type="radio" name="tv_rating" value="1"></td>
                            <td><input type="radio" name="tv_rating" value="2"></td>
                            <td><input type="radio" name="tv_rating" value="3"></td>
                            <td><input type="radio" name="tv_rating" value="4"></td>
                            <td><input type="radio" name="tv_rating" value="5"></td>
                        </tr>

                        <tr>
                            <td>I like to listen to the radio</td>
                            <td><input type="radio" name="radio_rating" value="1"></td>
                            <td><input type="radio" name="radio_rating" value="2"></td>
                            <td><input type="radio" name="radio_rating" value="3"></td>
                            <td><input type="radio" name="radio_rating" value="4"></td>
                            <td><input type="radio" name="radio_rating" value="5"></td>
                        </tr>   
                   </table>
                   <input type="submit" name="submit" id="submit" onclick="validate()">
                </form>
            </div>
        </div>
  
    </body>
</html>    