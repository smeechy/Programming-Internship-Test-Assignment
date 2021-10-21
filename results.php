<?php
    session_start();

    // connection to database
    require_once "config.php";

    //sql statement to get number of surveys
    $sql = 'SELECT COUNT(*) AS num_surveys FROM surveys';

    //prepare the sql statement to get number of surveys
    $stmt = $pdo->prepare($sql);

    //execute statement to get number of surveys
    $stmt->execute();

    //fetch number of rows returned by MYSQL
    $num_surveys = $stmt->fetch(PDO::FETCH_ASSOC);

    //sql statement to get average age
    $sql = 'SELECT AVG(age) AS avg_age FROM surveys';

    //prepare the sql statement to get average age
    $stmt = $pdo->prepare($sql);
    
    //execute statement to get average age
    $stmt->execute();

    //fetch average age returned by MYSQL
    $avg_age = $stmt->fetch(PDO::FETCH_ASSOC);

    //sql statement to get oldest person's age
    $sql = 'SELECT MAX(age) AS oldest FROM surveys';

    //prepare the sql statement to get oldest person's age
    $stmt = $pdo->prepare($sql);

    //execute statement to get oldest person's age
    $stmt->execute();

    //fetch oldest person's age returned by MYSQL
    $oldest = $stmt->fetch(PDO::FETCH_ASSOC);

    //sql statement to get youngest person's age
    $sql = 'SELECT MIN(age) AS youngest FROM surveys';

    //prepare the sql statement to get youngest person's age
    $stmt = $pdo->prepare($sql);

    //execute statement to get youngest person's age
    $stmt->execute();

    //fetch youngest person's age returned by MYSQL
    $youngest = $stmt->fetch(PDO::FETCH_ASSOC);

    //sql statement to get favourites
    $sql = 'SELECT favourites AS fav  FROM surveys';

    //prepare the sql statement to get favourites
    $stmt = $pdo->prepare($sql);

    //execute statement to get favourites
    $stmt->execute();

    //fetch all favourites
    $favourites = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //initialize percentage variables and set to 0
    $pizza_percentage = $pasta_percentage = $papAndWors_percentage = 0;

    //set favourites counters to 0
    $count_pizza = $count_pasta = $count_papAndWors = 0;

    if($favourites){
        foreach($favourites as $favourite){

            $pizza = "pizza";
            if(strpos($favourite['fav'],$pizza) !== false){
                $count_pizza += 1;
                $pizza_percentage = ($count_pizza/$num_surveys['num_surveys'])*100;
            }

            $pasta = "pasta";
            if(strpos($favourite['fav'],$pasta) !==false){
                $count_pasta += 1;
                $pasta_percentage = ($count_pasta/$num_surveys['num_surveys'])*100;   
            }

            $papAndWors = "pap&wors";
            if(strpos($favourite['fav'],$papAndWors) !== false){
                $count_papAndWors += 1;
                $papAndWors_percentage = ($count_papAndWors/$num_surveys['num_surveys'])*100;
            }

        }
    }


        //sql statement to get ratings
        $sql = 'SELECT outing_rating AS otr, movie_rating AS mr, tv_rating AS tr, radio_rating AS rr  FROM surveys';

        //prepare the sql statement to get ratings
        $stmt = $pdo->prepare($sql);
    
        //execute statement to get ratings
        $stmt->execute();
    
        //fetch all ratings
        $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //set variables equal to 0
        $otr = $mr = $tr = $rr= $avg_otr = $avg_mr = $avg_tr = $avg_rr = 0;

        if($ratings){
            foreach($ratings as $rating){
                $otr += $rating['otr'];
                $avg_otr = $otr/$num_surveys['num_surveys'];

                $mr += $rating['mr'];
                $avg_mr = $mr/$num_surveys['num_surveys'];

                $tr += $rating['tr'];
                $avg_tr = $tr/$num_surveys['num_surveys'];
                
                $rr += $rating['rr'];
                $avg_rr = $rr/$num_surveys['num_surveys'];
            }
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
        <div class="cover">
            <h1>Results</h1>
            <div class="results">
                <span>Total number of surveys:  <?=$num_surveys['num_surveys']?> </span> 
                <span>Average age:  <?=round($avg_age ['avg_age'],2)?></span> 
                <span>Oldest person who participated in survey:  <?=$oldest['oldest']?></span> 
                <span>Youngest person who participated in survey:  <?=$youngest['youngest']?></span> 
                <br>
                <br>
                <br>
                <span>Percentage of people who like Pizza:  <?=round($pizza_percentage,1)?>%</span>
                <span>Percentage of people who like Pasta:  <?=round($pasta_percentage,1)?>%</span>
                <span>Percentage of people who like Pap and Wors:  <?=round($papAndWors_percentage,1)?>%</span>
                <br>
                <br>
                <br>
                <span>People like to eat out:  <?=round($avg_otr,1)?></span>
                <span>People like to watch movies:  <?=round($avg_mr,1)?></span>
                <span>People like to watch TV:  <?=round($avg_tr,1)?> </span>
                <span>People like to eat listen to the radio:  <?=round($avg_rr,1)?></span>
                <br>
                <button><a href="index.php">OK</a></button>
            </div>
        </div>

    </body>
</html>