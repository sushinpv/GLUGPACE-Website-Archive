<?php
echo "
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>About | GLUG PACE</title>

        <!-- Bootstrap -->
        <link href='css/bootstrap.min.css' rel='stylesheet'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src='js/html5shiv.min.js'></script>
<script src='js/respond.min.js'></script>
<![endif]-->
    </head>
    <body>
        <header>
            <div class='navbar navbar-default navbar-fixed-top navbar-inverse'>
                <div class='container'>
                    <div class='navbar-header'>
                        <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#example'>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                        </button>
                        <a href='index.php' class='navbar-brand'>GLUG PACE</a>
                    </div>
                    <div class='collapse navbar-collapse navbar-right' id='example'>
                        <ul class='nav navbar-nav'>
                            <li class=''><a href='index.php'> Home </a></li>
                            <li class=''><a href='articles.php'> Articles </a></li>
                            <li class=''><a href='events.php'> Events </a></li>  
                            <li class='active'><a href='about.php'> About </a></li>    
                        </ul>
                        <form action='search.php' class='navbar-form navbar-right' role='search'>
                            <div class='form-group'>
                                <input type='text' name='search' class='form-control' placeholder='Search'>
                                <img >
                            </div>
                        </form>
                    </div>
                </div>      
            </div>
        </header>
        <div style='height:400px' class='well'>
            sample
        </div>
        <div class='container'>
            <div class='row'>
                <div class='col-md-3 col-sm-6'>
                    Sample content
                </div>
                <div class='col-md-3 col-sm-6'>
                    Sample content
                </div>
                <div class='col-md-3 col-sm-6'>
                    Sample content
                </div>
                <div class='col-md-3 col-sm-6'>
                    Sample content
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src='js/jquery.min.js'></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src='js/bootstrap.min.js'></script>
    </body>
</html>
";
?>