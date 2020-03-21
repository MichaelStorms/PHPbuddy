<?php


    ?>




<!DOCTYPE html>
<html>

<head>
    <title>Pop-up profiel vervolledigen</title>
    <script src="./vendor/jquery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>

    <!--Contact Form-->
    <div id="contact-popup">
        <form class="contact-form" action="" id="contact-form" method="post" enctype="multipart/form-data">
            <h1>What are your interests?</h1>
           
            <!--    interest 1 -->
            <div class="card" style="width: 18rem;">
                <img src="/images/location.svg" class="card-img-top" alt="location">
                <div class="card-body">
                    <p class="card-text">Location</p>
                </div>
                <a href="#" class="btn btn-primary">choose</a>
            </div>
            
            <!--    interest 2 -->
            <div class="card" style="width: 18rem;">
                <img src="/images/hobby.png" class="card-img-top" alt="hobby">
                <div class="card-body">
                    <p class="card-text">Hobby</p>
                </div>
                <a href="#" class="btn btn-primary">choose</a>
            </div>
                        
            <!--    interest 3 -->
            <div class="card" style="width: 18rem;">
                <img src="/images/food.svg" class="card-img-top" alt="foodie">
                <div class="card-body">
                    <p class="card-text">Foodie</p>
                </div>
                <a href="#" class="btn btn-primary">choose</a>
            </div>
                        
            <!--    interest 4 -->
            <div class="card" style="width: 18rem;">
                <img src="/images/gaming.svg" class="card-img-top" alt="gaming">
                <div class="card-body">
                    <p class="card-text">Gaming</p>
                </div>
                <a href="#" class="btn btn-primary">choose</a>
            </div>
                        
            <!--    interest 5 -->
            <div class="card" style="width: 18rem;">
                <img src="./PHPbuddy/" class="card-img-top" alt="course interests">
                <div class="card-body">
                    <p class="card-text">Course interests</p>
                </div>
                <a href="#" class="btn btn-primary">choose</a>
            </div>


            

            <div>
                <input type="submit" id="send" name="send" value="Send" />
            </div>
        </form>
    </div>
    <?php

    ?>
    <div id="success">Your interests were stored successfully!</div>

    
    
</body>

</html>