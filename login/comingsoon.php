<!DOCTYPE html>
<html>
<head>
    <title>Coming Soon</title>
    <style>
        body {
            text-align: center;
            padding: 100px;
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 30px;
        }
        .countdown {
            font-size: 24px;
            margin-bottom: 30px;
        }
        .button{
            position: relative;
            top: 200px;
            
            height: 40px;
            width: 90px;
            ;

            background-color: #04AA6D; /* Green */
            border: none;
            color: white;
          
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }
        a{
            text-decoration: none;
            color: white ;
        }
    </style>
</head>
<body>
    
<button class="button"><a href="login.php">BACK</a></button></a>
    <h1>Coming Soon</h1>
    <div class="countdown" id="countdown"></div>

    <script>
        // Set the date and time of the target launch
        var launchDate = new Date("2024-08-01T00:00:00").getTime();

        // Update the countdown every 1 second
        var countdown = setInterval(function() {
            var now = new Date().getTime();
            var distance = launchDate - now;

            // Calculate the days, hours, minutes, and seconds remaining
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the countdown
            document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

            // If the countdown is finished, display a message
            if (distance < 0) {
                clearInterval(countdown);
                document.getElementById("countdown").innerHTML = "Coming Soon!";
            }
        }, 1000);
    </script>
</body>
</html>
