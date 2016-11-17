<?php

$dbhost = 'localhost:3306';
$dbuser = 'xxxxx';
$dbpass = 'xxxxx';
$dbname = 'xxxxx';
$sample = 0;
$mysqli=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (mysqli_connect_errno($mysqli)){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>GLUG PACE</title>

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
                            <li class='active'><a href='events.php'> Events </a></li>  
                            <li><a href='about.php'> About </a></li> 	
                        </ul>
                        <form action='search.php' class='navbar-form navbar-right' role='search'>
                            <div class='form-group'>
                                <input type='text' name='search' class='form-control' placeholder='Search'>
                                <img >
                            </div>
                        </form>
                    </div>
                </div>    	
            </div>";
$sessionSelect=0;
if ($_GET['id'] &&  $_GET['type']=="events") {
	$sessionSelect=1;
    $id = $_GET['id'];
    $type = $_GET['type'];
    $query = "update visit_log set visit=visit+1 where type='".$type."' and id=".$id.";";
    $mysqli->query($query);
    $query = "select * from ".$type." where id=".$id.";";
    $item=0;
    $result = $mysqli->query($query);
   if ($result) {
        $row = $result->fetch_assoc();
        if($row){
echo "
            <div style='padding-bottom: 10px;' class='jumbotron'>
                <div class='container-one'>
                    <div class='carousel slide' data-ride='carousel' id='carousel-ex'>
                        <ol class='carousel-indicators'>
                            <li data-target='#carousel-ex' data-slide-to='0' class='active'></li>
                            <li data-target='#carousel-ex' data-slide-to='1'></li>
                            <li data-target='#carousel-ex' data-slide-to='2'></li>
                        </ol>
                        <div class='carousel-inner'>
                            <div class='item active'>
                                <img src='images/".$row['img1']."' alt='image'>
                            </div>
                            <div class='item'>
                                <img src='images/".$row['img2']."' alt='image'>
                            </div>
                            <div class='item'>
                                <img src='images/".$row['img3']."' alt='image'>
                                </div>
                            </div>
                            <a href='#carousel-ex' class='left carousel-control' data-slide='prev'>
                                <span class='glyphicon glyphicon-chevron-left'></span>
                            </a>
                            <a href='#carousel-ex' class='right carousel-control' data-slide='next'>
                                <span class='glyphicon glyphicon-chevron-right'></span>
                            </a>
                        </div>
                    </div>
                </div>
                <h2 style='margin-left:8%;'>".$row['name']."</h2>
            </div>
            <div class='container'>
                	<p style='text-align: justify;'>".$row['content_large']."</p>
            </div>
            ";
            
		}
		else{
    		$sessionSelect = 0;
    	}
    }
    else{
            $sessionSelect = 0;
        }
    
}
echo "
        </header>";

if($sessionSelect==0){
    $query = "update visit_log set visit=visit+1 where name='events.php';";
    $mysqli->query($query);
	echo "
		<div style='padding-bottom: 10px;' class='jumbotron'>
            <div class='container-one'>
                <div style='height:250px;background-image: url(images/background2.png)'>
                </div>
            </div>
            <h2 style='margin-left:10%;'>".$row['name']."</h2>
        </div>
		<div class='container'>
            <div class='row'>
                <div style='text-align:center' class='caption'><h2>EVENTS</h2></div>";
	#<!--   -->
	$query = "select * from events order by id desc;";
	$result = $mysqli->query($query);
   if ($result) {
        while($row = $result->fetch_assoc()){
            echo "
                <div class='col-sm-6 col-md-3'>
                    <div class='thumbnail'>
                        <img src='images/".$row['img1']."' alt='image'>
                        <div class='caption'>
                            <h3>".$row['name']."</h3>
                            <p style='text-align: justify'>".$row['content_small']."</p>
                            <a href='events.php?id=".$row['id']."&type=events' class='btn btn-primary' role='button'>Read more</a>
                        </div>
                    </div>
                </div>";
        }
    }
echo "                
            </div>
        </div>";
}

echo "
        <footer id='footer'>
            <!-- .container -->
            <div class='container' style='text-align:center'>
                <p class='copyright-txt'>".date("Y")." | <a href='http://glugpace.in/' target='_blank'>GLUG PACE</a></p>
                <div class='socials'>
                    <a href='#' title='Facebook' class='link-facebook'><i class='fa fa-facebook'></i></a>
                    <a href='#' title='Twitter' class='link-twitter'><i class='fa fa-twitter'></i></a>
                    <a href='#' title='Google Plus' class='link-google-plus'><i class='fa fa-google-plus'></i></a>
                </div>
            </div>
            <!-- .container end -->

        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src='js/jquery.min.js'></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src='js/bootstrap.min.js'></script>
        <script type='text/javascript' src='js/smoothscroll.js'></script>
    </body>
</html>
            ";

?>