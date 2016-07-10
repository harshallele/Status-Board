<!DOCTYPE html>



<html lan="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </head>
    <body>
    
        
        <div class="container-fluid">
            
            <!--Header-->
            <div class="container-fluid text-center text-google-WorkSans header">
                <h1>Status Board</h1>
                <class="col-md-6 ostext"><h5></h5></class>
                <class="col-md-6 uptimetext"><h5></h5></class>
                
                
            </div>
            
            <!--Nav bar-->
            <div class="container-fluid navbar navbar-inverse">
                <ul class="nav navbar-nav">
                    <li class="text-google-WorkSans"><a href="#"><h4>System Information</h4></a></li>
                    <li class="text-google-WorkSans"><a href="#"><h4>About</h4></a></li>
                </ul>
                
            </div>
            
            <div class="container-fluid">
                <!--System Info-->
                <div class="sysinfo row">
                    <div class="row  text-center">
                        <div class="col-md-6 cpuinfo" >

                            <h3>CPU</h3>
                        </div>

                        <div class="col-md-6 meminfo" >
                            <h3>Memory</h3>
                        </div>
                    </div>

                    <div class="row diskinfo text-center text-google-WorkSans">
                        <h3>Hard Drive</h3>

                    </div>

                </div>

                <!--About page. The display:none is disabled when the 'About' button in navbar is clicked-->
                <div class="aboutscreen" style="display:none">

                </div>

            </div>
            
            
        
    
    
    
        
        <!--Bootstrap-->
    
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"   crossorigin="anonymous"></script>
        
        
        <!--Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
        
        <!--my own css/js -->
        <link href="css/styles.css" rel="stylesheet">
        <script src="js/main.js"></script>
    </body>



</html>