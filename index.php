<?php

$dbhost = 'localhost:3306';
$dbuser = 'xxxxx';
$dbpass = 'xxxxx';
$dbname = 'xxxxxx';
$sample = 0;
$mysqli=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (mysqli_connect_errno($mysqli)){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query = "update visit_log set visit=visit+1 where name='index.php';";
$mysqli->query($query);
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
                        <a href='' class='navbar-brand'>GLUG PACE</a>
                    </div>
                    <div class='collapse navbar-collapse navbar-right' id='example'>
                        <ul class='nav navbar-nav'>
                            <li class='active'><a href=''> Home </a></li>
                            <li><a href='articles.php'> Articles </a></li>
                            <li><a href='events.php'> Events </a></li>  
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
            </div>
            <div class='jumbotron'>
                <div class='container-one'>
                    <div class='carousel slide' data-ride='carousel' id='carousel-ex'>
                        <div class='carousel-inner'>";
$query = "select * from header_background;";
$item=0;
$result = $mysqli->query($query);
   if ($result) {
        $itemno=0;
        while($row = $result->fetch_assoc()){
            $itemno = $itemno+1;
            $item = $itemno;
            if($itemno==1)
                echo "
                            <div class='item active'>";
            else
                echo "
                            <div class='item'>";
            echo "
                                <img src='images/".$row['img']."' alt='image'>
                                <div class='carousel-caption'>
                                    <h2>".$row['name']."</h2>
                                    <p>".$row['content']."</p>
                                </div>
                            </div>";
        }
    }
echo "
                        <ol class='carousel-indicators'>
                             <li data-target='#carousel-ex' data-slide-to='0' class='active'></li>";
for ($i=1; $i< $itemno ; $i++) { 
    echo "
                            <li data-target='#carousel-ex' data-slide-to='".$i."'></li>";
}
echo "
                        </ol>
                            <a href='#carousel-ex' class='left carousel-control' data-slide='prev'>
                                <span class='glyphicon glyphicon-chevron-left'></span>
                            </a>
                            <a href='#carousel-ex' class='right carousel-control' data-slide='next'>
                                <span class='glyphicon glyphicon-chevron-right'></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class='container'>
            <div class='row'>
                <div style='text-align:center' class='caption'><h2>WHAT'S NEW</h2></div>";
#<!--   -->
$query = "select * from whatsnew order by id desc;";
$result = $mysqli->query($query);
   if ($result) {
        $count=0;
        for ($i=0; $i <4 ; $i++) { 
            if($row = $result->fetch_assoc()){
                echo "
                <div class='col-sm-6 col-md-3'>
                    <div class='thumbnail'>
                        <img src='images/".$row['img']."' alt='image'>
                        <div class='caption'>
                            <h3>".$row['name']."</h3>
                            <p style='text-align: justify'>".$row['content_small']."</p>
                            <a href='articles.php?id=".$row['id']."&type=whatsnew' class='btn btn-primary' role='button'>Read more</a>
                        </div>
                    </div>
                </div>";
            }
        }
        
    }
echo "                
            </div>";
#            <div class='row' id='technical'>
#                <div style='text-align:center' class='caption'><h2>TECHNICAL</h2></div>";
#$query = "select * from technical;";
#$result = $mysqli->query($query);
#   if ($result) {
#        while($row = $result->fetch_assoc()){
#            echo "
#                <div class='col-sm-6 col-md-3'>
#                    <div class='thumbnail'>
#                        <img src='images/".$row['img']."' alt='image'>
#                        <div class='caption'>
#                            <h3>".$row['name']."</h3>
#                            <p>".$row['content']."</p>
#                            <a href='#' class='btn btn-primary' role='button'>Read more</a>
#                        </div>
#                    </div>
#                </div>";
#        }
#    }
echo "
        </div>
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
</html>";
?>