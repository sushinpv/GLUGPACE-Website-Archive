<?php

$dbhost = 'localhost:3306';
$dbuser = 'xxxxx';
$dbpass = 'xxxxxx';
$dbname = 'xxxxxx';
$sample = 0;
$mysqli=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (mysqli_connect_errno($mysqli)){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

session_start();

if ($_POST["user"] && $_POST['pass']) {
    $username = $_POST["user"];
    $password = $_POST["pass"];
    $query = "select username from admins where username = '".$username."' and password = '".$password."';";
    $result = $mysqli->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        if($row['username']==$username){
            $_SESSION['login']="true";
            $_SESSION['user']=$username;
            $_SESSION['pass']=$password;
        }
    }
}
if ($_POST['logout'] or $_GET['logout']) {
    $_SESSION['login']="false";
    $_SESSION['user'] = "null";
    $_SESSION['pass']="null";
}

if ($_SESSION["login"]=="true") {

    #### To add contents to the database //should convert--> bit|wise, image comperssor

    if ($_GET['heading']  && $_GET['content_large'] && ($_GET['img'] or $_GET['img1'] or $_GET['img2'] or $_GET['img3']) && $_GET['type']) {
        $heading = $_GET['heading'];
        $content_large = (String)$_GET['content_large'];

        ### Get the images
        
        $type = $_GET['type'];
        if ($type=="whatsnew" or $type=="technical" or $type=="nontechnical") {
            $newid = 0;
            $query = "select max(id) from ".$type.";";
            $result = $mysqli->query($query);
            if ($row = $result->fetch_assoc()) {
                $newid = $row['max(id)']+1;
            }
            $content_small="sample";
            for ($i=0; $i <299 ; $i++) { 
                $content_small[$i] = $content_large[$i];
            }
            $query = "insert into ".$type." values(".$newid.",\"".$heading."\",\"".$content_small."\",\"".$content_large."\",'whatsnew1.png') ;";
            $mysqli->query($query);
            $query = "insert into visit_log values(\"".$type."\",\"".$heading."\",".$newid.",0);";
            $mysqli->query($query);
        }
        if ($type == "events") {
            # code...
        }

    }

    ### To Change password

    if ($_GET['change']=="user" and $_GET["pass"]) {
        $pass = $_GET['pass'];
        $query = "update admins set password='".$pass."' where username='".$_SESSION['user']."';";
        $mysqli->query($query);
        $_SESSION['pass'] = $pass;
    }

    #### To Delete content from database

    if($_GET['val']=="del" and $_GET["id"]!="" and $_GET["type"]!=""){
        $delId = $_GET["id"];
        $delType = $_GET["type"];
        $query = "delete from ".$delType." where id=".$delId.";";
        $result = $mysqli->query($query);
        $query = "delete from visit_log where type=\"".$delType."\" and id=".$delId.";";
        $mysqli->query($query);
    }


    ### TO add new user

    if ($_GET['user'] && $_GET['pass'] && $_GET['add']=="user" && $_SESSION['user']=="Admin") {
        $username = $_GET['user'];
        $password = $_GET['pass'];
        $query = "insert into admins values('".$username."','".$password."');";
        $mysqli->query($query);
    }

    ### TO delete user

    if ($_GET['user'] && $_GET['del']=="user" && $_SESSION['user']=="Admin") {
        $username = $_GET['user'];
        $password = $_GET['pass'];
        $query = "delete from admins where username='".$username."';";
        $mysqli->query($query);
    }

    ### To check password of the user

    if ($_POST['passwordCheck']=="user" && $_POST['pass']) {
        $query = "select username from admins where uesrname = '".$_SESSION['user']."' and password='".$_GET['pass']."'";
        $result = $mysqli->query($query);
        if ($row = $result->fetch_assoc()) {
            return "true";
        }
        return "false";
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
        <link href='css/sb-admin.css' rel='stylesheet'>
        <link href='css/admin.css' rel='stylesheet'>

        <!-- Custom Fonts -->
        <link href='font/font-awesome.min.css' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src='js/html5shiv.min.js'></script>
        <script src='js/respond.min.js'></script>
        <![endif]-->
        <script src='js/admin1.js'></script>
    </head>
    <body>
        <header>
            <nav class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
                        <span class='sr-only'>Toggle navigation</span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                    </button>
                    <a class='navbar-brand' href='index.php'>GLUG PACE</a>
                </div>
                <!-- Top Menu Items -->
                <ul class='nav navbar-right top-nav'>
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-user'></i> GLUG - ".$_SESSION['user']." <b class='caret'></b></a>
                        <ul class='dropdown-menu'>";

    ### To get users option for Admin

    if ($_SESSION['user']=='Admin') {
        echo "
                            <li>
                                <a data-toggle='modal' data-target='#users_modal'><i class='fa fa-fw fa-gear'></i> Users</a>
                            </li>
                            <li class='divider'></li>";
    }
    echo "
                            <li>
                                <a data-toggle='modal' data-target='#settings_modal'><i class='fa fa-fw fa-power-off'></i>Settings</a>
                            </li>
                            <li class='divider'></li>
                            <li>
                                <a href='admin.php?logout=lg'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class='collapse navbar-collapse navbar-ex1-collapse'>
                    <ul class='nav navbar-nav side-nav'>
            ";

    if($_GET['page']=="whatsnew.html"){
        echo "
                        <li>
                            <a href='admin.php?page=index.html'><i class='fa fa-fw fa-dashboard'></i> Dashboard</a>
                        </li>
                        <li class='active'>
                            <a href='admin.php?page=whatsnew.html'><i class='fa fa-fw fa-bar-chart-o'></i> What's New</a>
                        </li>
                        <li>
                            <a href='admin.php?page=events.html'><i class='fa fa-fw fa-table'></i> Events</a>
                        </li>
                        <li>
                            <a href='javascript:;' data-toggle='collapse' data-target='#demo'><i class='fa fa-fw fa-arrows-v'></i> Articles <i class='fa fa-fw fa-caret-down'></i></a>
                            <ul id='demo' class='collapse'>
                                <li>
                                    <a href='admin.php?page=technical.html'>Technical</a>
                                </li>
                                <li>
                                    <a href='admin.php?page=nontechnical.html'>Non-Technical</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='admin.php?page=about.html'><i class='fa fa-fw fa-table'></i> About</a>
                        </li>";
    }
    else if($_GET['page']=="events.html"){
        echo "
                        <li >
                            <a href='admin.php?page=index.html'><i class='fa fa-fw fa-dashboard'></i> Dashboard</a>
                        </li>
                        <li>
                            <a href='admin.php?page=whatsnew.html'><i class='fa fa-fw fa-bar-chart-o'></i> What's New</a>
                        </li>
                        <li class='active'>
                            <a href='admin.php?page=events.html'><i class='fa fa-fw fa-table'></i> Events</a>
                        </li>
                        <li>
                            <a href='javascript:;' data-toggle='collapse' data-target='#demo'><i class='fa fa-fw fa-arrows-v'></i> Articles <i class='fa fa-fw fa-caret-down'></i></a>
                            <ul id='demo' class='collapse'>
                                <li>
                                    <a href='admin.php?page=technical.html'>Technical</a>
                                </li>
                                <li>
                                    <a href='admin.php?page=nontechnical.html'>Non-Technical</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='admin.php?page=about.html'><i class='fa fa-fw fa-table'></i> About</a>
                        </li>";
    }
    else if($_GET['page']=="technical.html" or $_GET['page']=="nontechnical.html"){
        echo "
                        <li>
                            <a href='admin.php?page=index.html'><i class='fa fa-fw fa-dashboard'></i> Dashboard</a>
                        </li>
                        <li>
                            <a href='admin.php?page=whatsnew.html'><i class='fa fa-fw fa-bar-chart-o'></i> What's New</a>
                        </li>
                        <li>
                            <a href='admin.php?page=events.html'><i class='fa fa-fw fa-table'></i> Events</a>
                        </li>
                        <li class='active'>
                            <a href='javascript:;' data-toggle='collapse' data-target='#demo'><i class='fa fa-fw fa-arrows-v'></i> Articles <i class='fa fa-fw fa-caret-down'></i></a>
                            <ul id='demo' class='collapse'>
                                <li>
                                    <a href='admin.php?page=technical.html'>Technical</a>
                                </li>
                                <li>
                                    <a href='admin.php?page=nontechnical.html'>Non-Technical</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='admin.php?page=about.html'><i class='fa fa-fw fa-table'></i> About</a>
                        </li>";
    }
    else if($_GET['page']=="about.html"){
        echo "
                        <li >
                            <a href='admin.php?page=index.html'><i class='fa fa-fw fa-dashboard'></i> Dashboard</a>
                        </li>
                        <li>
                            <a href='admin.php?page=whatsnew.html'><i class='fa fa-fw fa-bar-chart-o'></i> What's New</a>
                        </li>
                        <li>
                            <a href='admin.php?page=events.html'><i class='fa fa-fw fa-table'></i> Events</a>
                        </li>
                        <li>
                            <a href='javascript:;' data-toggle='collapse' data-target='#demo'><i class='fa fa-fw fa-arrows-v'></i> Articles <i class='fa fa-fw fa-caret-down'></i></a>
                            <ul id='demo' class='collapse'>
                                <li>
                                    <a href='admin.php?page=technical.html'>Technical</a>
                                </li>
                                <li>
                                    <a href='admin.php?page=nontechnical.html'>Non-Technical</a>
                                </li>
                            </ul>
                        </li>
                        <li class='active'>
                            <a href='admin.php?page=about.html'><i class='fa fa-fw fa-table'></i> About</a>
                        </li>";
    }
    else{
        echo "
                        <li class='active'>
                            <a href='admin.php?page=index.html'><i class='fa fa-fw fa-dashboard'></i> Dashboard</a>
                        </li>
                        <li>
                            <a href='admin.php?page=whatsnew.html'><i class='fa fa-fw fa-bar-chart-o'></i> What's New</a>
                        </li>
                        <li>
                            <a href='admin.php?page=events.html'><i class='fa fa-fw fa-table'></i> Events</a>
                        </li>
                        <li>
                            <a href='javascript:;' data-toggle='collapse' data-target='#demo'><i class='fa fa-fw fa-arrows-v'></i> Articles <i class='fa fa-fw fa-caret-down'></i></a>
                            <ul id='demo' class='collapse'>
                                <li>
                                    <a href='admin.php?page=technical.html'>Technical</a>
                                </li>
                                <li>
                                    <a href='admin.php?page=nontechnical.html'>Non-Technical</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='admin.php?page=about.html'><i class='fa fa-fw fa-table'></i> About</a>
                        </li>";
    }
    echo"
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </header>

        <div style='margin-right:0px' id=wrapper>
            <div id=page-wrapper>
                <div class=container-fluid>
                    <div class=row>
                        <div class=col-lg-12>";
    #
    #   
    #   To set the contents accounding to the page
    #
    #

    if($_GET['page']=="whatsnew.html"){
        echo "
                            <h1 class=page-header>
                                What's New
                            </h1>
                            <ol class=breadcrumb>
                                <li>
                                    <i class=fa fa-dashboard></i>  <a href=admin.php>Dashboard</a>
                                </li>
                                <li class=active>
                                    <i class=fa fa-bar-chart-o></i> What's New
                                </li>
                                <li><button type='button' class='btn btn-defalut' data-toggle='modal' data-target='#modal-add'>Add</button>
                                    <div class='modal fade' id='modal-add'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <form action='admin.php' method=GET name='page'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <h3 class='modal-title'>What's New?</h3>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div class='form-group'>
                                                            <label>Heading</label>
                                                            <input maxlenght=100 name='heading' class='form-control'>
                                                            <p class='help-block'>Example 'What's new in this world'.</p>
                                                            <label>Content (max:10,000)</label>
                                                            <textarea maxlenght=10000 name='content_large' class='form-control' rows='5'></textarea>
                                                            <label>Select Image (max:250Kb)</label>
                                                            <input name='img' type='file'>
                                                            <input name='page' value='whatsnew.html' style='height:0px;width:0px;visibility: hidden;'>
                                                            <input name='type' value='whatsnew' style='height:0px;width:0px;visibility: hidden;'>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                                        <button class='btn btn-primary' type='submit'>Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
        ";
        $query = "select * from whatsnew order by id desc;";
        $result = $mysqli->query($query);
        if ($result) {
            while($row = $result->fetch_assoc()){
                echo "
                            <div class='col-sm-6 col-md-3'>
                                <div class='thumbnail'>
                                    <img src='images/".$row['img']."' alt='image'>
                                    <div class='caption'>
                                        <h3>".$row['name']."</h3>
                                        <p style='text-align: justify'>".$row['content_small']."</p>
                                        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal-".$row['id']."'>Remove</button>
                                        <div class='modal fade' id='modal-".$row['id']."'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <h3 class='modal-title'>Do you realy want to delete?</h3>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <h4>".$row['name']."</h4><p style='padding-left:20px'>".$row['content_small']."</p>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                                        <a href='admin.php?page=whatsnew.html&val=del&id=".$row['id']."&type=whatsnew' class='btn btn-primary' role='button'>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
            }
        }
    }
    else if($_GET['page']=="events.html"){
        echo "
                            <h1 class=page-header>
                                Events
                            </h1>
                            <ol class=breadcrumb>
                                <li>
                                    <i class=fa fa-dashboard></i>  <a href=admin.php>Dashboard</a>
                                </li>
                                <li class=active>
                                    <i class=fa fa-bar-chart-o></i> Events
                                </li>
                                <li><button type='button' class='btn btn-defalut' data-toggle='modal' data-target='#modal-add'>Add</button>
                                    <div class='modal fade' id='modal-add'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <form action='admin.php' method=GET name='page'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <h3 class='modal-title'>Events</h3>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div class='form-group'>
                                                            <label>Heading</label>
                                                            <input maxlenght=100 name='heading' class='form-control'>
                                                            <p class='help-block'>Example 'Bytestruck'.</p>
                                                            <label>Content (max:10,000)</label>
                                                            <textarea maxlenght=10000 name='content_large' class='form-control' rows='5'></textarea>
                                                            <label>Select Image's (max:250Kb)</label>
                                                            <input name='img1' type='file'>
                                                            <input name='img2' type='file'>
                                                            <input name='img3' type='file'>
                                                            <input name='page' value='events.html' style='height:0px;width:0px;visibility: hidden;'>
                                                            <input name='type' value='events' style='height:0px;width:0px;visibility: hidden;'>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                                        <button class='btn btn-primary' type='submit'>Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
        ";
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
                                        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal-".$row['id']."'>Remove</button>
                                        <div class='modal fade' id='modal-".$row['id']."'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <h3 class='modal-title'>Do you realy want to delete?</h3>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <h4>".$row['name']."</h4><p style='padding-left:20px'>".$row['content_small']."</p>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                                        <a href='admin.php?page=events.html&val=del&id=".$row['id']."&type=events' class='btn btn-primary' role='button'>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
            }
        }
    }
    else if($_GET['page']=="technical.html"){
        echo "
                            <h1 class=page-header>
                                Technical
                            </h1>
                            <ol class=breadcrumb>
                                <li>
                                    <i class=fa fa-dashboard></i>  <a href=admin.php>Dashboard</a>
                                </li>
                                <li>
                                    <i class=fa fa-dashboard></i>Articles
                                </li>
                                <li class=active>
                                    <i class=fa fa-bar-chart-o></i> Technical
                                </li>
                                <li><button type='button' class='btn btn-defalut' data-toggle='modal' data-target='#modal-add'>Add</button>
                                    <div class='modal fade' id='modal-add'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <form action='admin.php' method=GET name='page'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <h3 class='modal-title'>Technical</h3>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div class='form-group'>
                                                            <label>Heading</label>
                                                            <input maxlenght=100 name='heading' class='form-control'>
                                                            <p class='help-block'>Example 'What is FOSS?'.</p>
                                                            <label>Content (max:10,000)</label>
                                                            <textarea maxlenght=10000 name='content_large' class='form-control' rows='5'></textarea>
                                                            <label>Select Image (max:250Kb)</label>
                                                            <input name='img' type='file'>
                                                            <input name='page' value='technical.html' style='height:0px;width:0px;visibility: hidden;'>
                                                            <input name='type' value='technical' style='height:0px;width:0px;visibility: hidden;'>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                                        <button class='btn btn-primary' type='submit'>Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
        ";
        $query = "select * from technical order by id desc;";
        $result = $mysqli->query($query);
        if ($result) {
            while($row = $result->fetch_assoc()){
                echo "
                            <div class='col-sm-6 col-md-3'>
                                <div class='thumbnail'>
                                    <img src='images/".$row['img']."' alt='image'>
                                    <div class='caption'>
                                        <h3>".$row['name']."</h3>
                                        <p style='text-align: justify'>".$row['content_small']."</p>
                                        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal-".$row['id']."'>Remove</button>
                                        <div class='modal fade' id='modal-".$row['id']."'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <h3 class='modal-title'>Do you realy want to delete?</h3>
                                                    </div>
                                                        <div class='modal-body'>
                                                        <h4>".$row['name']."</h4><p style='padding-left:20px'>".$row['content_small']."</p>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                                        <a href='admin.php?page=technical.html&val=del&id=".$row['id']."&type=technical' class='btn btn-primary' role='button'>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
            }
        }
    }
    else if($_GET['page']=="nontechnical.html"){
        echo "
                            <h1 class=page-header>
                                Non-Technical
                            </h1>
                            <ol class=breadcrumb>
                                <li>
                                    <i class=fa fa-dashboard></i>  <a href=admin.php>Dashboard</a>
                                </li>
                                <li>
                                    <i class=fa fa-dashboard></i>Articles
                                </li>
                                <li class=active>
                                    <i class=fa fa-bar-chart-o></i> Non-Technical
                                </li>
                                <li><button type='button' class='btn btn-defalut' data-toggle='modal' data-target='#modal-add'>Add</button>
                                    <div class='modal fade' id='modal-add'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <form action='admin.php' method=GET name='page'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <h3 class='modal-title'>Non-Technical</h3>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div class='form-group'>
                                                            <label>Heading</label>
                                                            <input maxlenght=100 name='heading' class='form-control'>
                                                            <p class='help-block'>Example 'Who are you?'.</p>
                                                            <label>Content (max:10,000)</label>
                                                            <textarea maxlenght=10000 name='content_large' class='form-control' rows='5'></textarea>
                                                            <label>Select Image (max:250Kb)</label>
                                                            <input name='img' type='file'>
                                                            <input name='page' value='nontechnical.html' style='height:0px;width:0px;visibility: hidden;'>
                                                            <input name='type' value='nontechnical' style='height:0px;width:0px;visibility: hidden;'>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                                        <button class='btn btn-primary' type='submit'>Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
        ";
        $query = "select * from nontechnical order by id desc;";
        $result = $mysqli->query($query);
        if ($result) {
            while($row = $result->fetch_assoc()){
                echo "
                            <div class='col-sm-6 col-md-3'>
                                <div class='thumbnail'>
                                    <img src='images/".$row['img']."' alt='image'>
                                    <div class='caption'>
                                        <h3>".$row['name']."</h3>
                                        <p style='text-align: justify'>".$row['content_small']."</p>
                                        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal-".$row['id']."'>Remove</button>
                                        <div class='modal fade' id='modal-".$row['id']."'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <h3 class='modal-title'>Do you realy want to delete?</h3>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <h4>".$row['name']."</h4><p style='padding-left:20px'>".$row['content_small']."</p>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                                        <a href='admin.php?page=nontechnical.html&val=del&id=".$row['id']."&type=nontechnical' class='btn btn-primary' role='button'>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";    
            }
        }
    }
    else if($_GET['page']=="about.html"){
        echo "
                            <h1 class=page-header>
                                About
                            </h1>
                            <ol class=breadcrumb>
                                <li>
                                    <i class=fa fa-dashboard></i>  <a href=admin.php>Dashboard</a>
                                </li>
                                <li class=active>
                                    <i class=fa fa-bar-chart-o></i> About
                                </li>
                            </ol>
                            <div class='well'>
                                <div class='container'>
                                    <label>Designed & Developed By</label>
                                    <div style='text-align:center' class='row'>
                                        <div class='col-md-4 col-sm-6'>
                                            <div class='page-header'>
                                                <h1>NEOCRUX <sup class='sup'>&reg;</sup></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        ";
    }
    else{
        echo "
                            <h1 class=page-header>
                                Dashboard
                            </h1>
                            <ol class=breadcrumb>
                                <li>
                                    <i class=' active   fa fa-dashboard'></i>  <a href=admin.php>Dashboard</a>
                                </li>
                            </ol>
                            <div class='well'>
                                <table class='table table-striped'>
                                    <tr><th>#</th><th>Content Type</th><th>Index</th><th>Name</th><th>No of views</th><th>%</th></tr>
                                    ";
        $totalvisit = 0;
        $query = "select sum(visit) from visit_log";
        $result = $mysqli->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            $totalvisit = $row['sum(visit)'];
        }
        $query = "select name,type,id,visit from visit_log order by type;";
        $result = $mysqli->query($query);
        if ($result) {
            $i = 0;
            while($row = $result->fetch_assoc()){
                $i = $i+1;
                echo "<tr><td>".$i."</td><td>".$row['type']."</td><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['visit']."</td><td>".sprintf("%0.2f",($row['visit']*100/$totalvisit))."%</td></tr>
                                    ";
            }
        }

        echo "<tr><td>#</td><td>Total</td><td>-</td><td style='text-align:left'>-----</td><td>".$totalvisit."</td><td>100%</td></tr>                
                                </table>
                            </div>";
    }

    #
    #
    #   End of content accoding to the page
    #
    #
    echo "
                        </div>
                    </div>
                </div>
            </div>";
    if ($_SESSION['user']=="Admin") {
        echo "
            <div class='modal fade' id='users_modal'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h3 class='modal-title'>Users</h3>
                        </div>
                        <div class='modal-body'>
                            <form action='admin.php'>
                                <div class='form-group'>
                                    <label>Add User</label>
                                    <div class='form-group'>
                                        <div class='form-group input-group'>
                                            <span class='input-group-addon'>@</span>
                                            <input name='user' class='form-control' placeholder='Username' type='text'>
                                            <span class='input-group-addon'>#</span>
                                            <input name='pass' class='form-control' placeholder='Password' type='text'>
                                        </div>
                                    </div>
                                    <input name='add' value='user' style='width:0px;height:0px;visibility:hidden'/>
                                </div>
                                <div style='text-align:right'>
                                    <button style='margin-top:-70px' type='submit' class='btn btn-primary'>Add</button>
                                </div>
                            </form>
                            <label>Users</label>";

        ##  Add users dynamically
        
        $query = "select username from admins";
        $result = $mysqli->query($query);
        echo "
                            <div class='row'>
        ";
        while($row=$result->fetch_assoc()){
            if($row['username']!="Admin"){
                echo "
                                <div class='col-md-3'>
                                    <div class='card' style='text-align:center;padding-top:20px'>
                                        <div style='text-align:right;margin-right:10px;margin-top:-15px'>
                                            <a href='admin.php?del=user&user=".$row['username']."'>&times;</a>
                                        </div>
                                        <img src='images/user.png' alt='Avatar' style='width:30%;align:center;'>
                                        <div class='container2'>
                                            <h4><b>".$row['username']."</b></h4>
                                        </div>
                                    </div>
                                </div>
                ";
            }
        }

        echo "
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <a href='' class='btn btn-default' data-dismiss='modal'>Close</a>
                        </div>
                    </div>
                </div>
            </div>";
    }
    echo "
            <div class='modal fade' id='settings_modal'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h3 class='modal-title'>Change Password</h3>
                        </div>
                        <div class='modal-body'>
                            <label>".$_SESSION['user']."</label>
                            <div id='cur_pass_group'>
                                <div class='form-group input-group'>
                                    <span class='input-group-addon'>$</span>
                                    <input id='curpass' name='newpass' class='form-control' placeholder='Current Password' type='password'>
                                    <input id='valpass' value='".$_SESSION['pass']."' class='hide'/>
                                </div>
                            </div>
                            <div class='form-group hide' id='pass_group'>
                                <div class='form-group input-group'>
                                    <span class='input-group-addon'>$</span>
                                    <input id='newpass' name='newpass' class='form-control' placeholder='New Password' type='password'>
                                    <span class='input-group-addon'>$</span>
                                    <input id='confirmpass' name='confirmpass' class='form-control' placeholder='Confirm Password' type='password'>
                                </div>
                            </div>
                            <input value='sample' id='status' name='status' class='status hide'/>
                        </div>
                        <div class='modal-footer'>
                            <div id='div1'>
                                <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                <input id='checkbtn' value='Check' onclick='checkpwd()' class='btn btn-primary' type='button'/>
                            </div>
                            <div class='hide' id='div2'>
                                <a href='admin.php?logout=lg' class='btn btn-primary'>Reload</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer id='footer'>
        <!-- .container -->
            <div class='container' style='text-align:center;margin-top:20px;'>
                <p style='color:white' class='copyright-txt'>".date("Y")." | <a href='http://glugpace.in/' target='_blank'>GLUG PACE</a></p>
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
        <!-- Page contents -->
    </body>
</html>
";
}
else{
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
        <style type='text/css'>
            .btnn:hover{
                color: white;
                background-color: #f85555;
            }
        </style>
        <script src='js/admin.js'></script>
    </head>
    <body style='background-color:#383838'>
        <div style='text-align:center;margin-top:200px' class='container'>
            <div class='row'>
                <div style='text-align:left' class='modal fade' id='modallogin'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <form action='admin.php' method=POST name='page'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                    <h3 class='modal-title'>GLUG PACE - LOGIN</h3>
                                </div>
                                <div class='modal-body'>
                                    <div class='form-group'>
                                        <div class='form-group input-group'>
                                            <span class='input-group-addon'>@</span>
                                            <input name='user' class='form-control' placeholder='Username' type='text'>
                                        </div>
                                        <div class='form-group input-group'>
                                            <span class='input-group-addon'>@</span>
                                            <input name='pass' class='form-control' placeholder='Password' type='password'>
                                        </div>
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                    <button class='btn btn-primary' type='submit'>LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div style='text-align:left' class='modal fade' id='modalreset'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h3 class='modal-title'>You Loose</h3><br/>
                                <p>You are failed to complete the puzzle</p>
                            </div>
                            <div class='modal-footer'>
                                <a href='' class='btn btn-default' data-dismiss='modal'>Cancel</a>
                                <button class='btn btn-primary' onclick='reset()' type='submit'>Reset</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='col-sm-6 col-md-8'>
                    <p><h1 style='color:white' class='page-header'>GLUG PACE</h1></p>
                    <h4 class='page-content' style='padding:0px 20px;color:white'>GNU/Linux User Group, PACE is a group of engineering students that promote and educate use of free and open source softwares.</h4>
                </div>
                <div class='col-sm-6 col-md-4'>
                    <div class='thumbnail'>
                        <div class='caption'>
                            <h3>PUZZLE</h3>
                            <button id='btn1' style='width:30%;height:60px' type='button' class='btn btn-defalut btnn' onclick=btn('btn1')>1</button>
                            <button id='btn2' style='width:30%;height:60px' type='button' class='btn btn-defalut btnn' onclick=btn('btn2')>2</button>
                            <button id='btn3' style='width:30%;height:60px' type='button' class='btn btn-defalut btnn' onclick=btn('btn3')>3</button>
                            <button id='btn4' style='width:30%;height:60px;margin-top:5px' type='button' class='btn btn-defalut btnn' onclick=btn('btn4')>4</button>
                            <button id='btn5' style='width:30%;height:60px;margin-top:5px' type='button' class='btn btn-defalut btnn' onclick=btn('btn5')>5</button>
                            <button id='btn6' style='width:30%;height:60px;margin-top:5px' type='button' class='btn btn-defalut btnn' onclick=btn('btn6')>6</button>
                            <button id='btn7' style='width:30%;height:60px;margin-top:5px;margin-bottom:20px' type='button' class='btn btn-defalut btnn' onclick=btn('btn7')>7</button>
                            <button id='btn8' style='width:30%;height:60px;margin-top:5px;margin-bottom:20px' type='button' class='btn btn-defalut btnn' onclick=btn('btn8')>8</button>
                            <button id='btn9' style='width:30%;height:60px;margin-top:5px;margin-bottom:20px' type='button' class='btn btn-defalut btnn' onclick=btn('btn9')>9</button>
                        </div>
                    </div>
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
}

?>