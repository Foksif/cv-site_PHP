<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" type="image/x-icon" href="Images/cv.png" />
    <link rel="stylesheet" href="style.css" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/aa1a7f25aa.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="main-header">
            <nav>
                <ul class="nav_links">
                    <li><a id="name" href="viewcv.php">Home</a></li>
                    <?php
                    session_start();
                    if (isset($_SESSION["username"])) {
                        $id = $_SESSION['username'];
                        echo "<li><a  class='button' href='profile.php?alpha=$id'>Profile</a></li>";
                        echo "<li><a  class='button' href='logout.php'>Log Out</a></li>";
                    } else {
                        echo "<li><a  class='button' href='register.php'>Sign up</a></li>";
                        echo "<li><a  class='button' href='index.php'>Log In</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <br />

    <div style="padding: 30px; font-family: 'Montserrat'">

        <h2 style="color: rgb(102, 139, 170);">List of all CV's</h2>
        <br>
        <h2 style="font-size:15px; color:white; font-family: 'Montserrat'">Search by name or key programming language:</h2><br>

        <form method="post" action="cvsearch.php">
            <input id="firstname" type="text" name="search">
            <input id='submit' name='submit' type='submit' style='font-size:13px' value='Search'>
        </form><br><br>

        <?php
        require_once('connectdb.php');
        try {

            $query = ("SELECT * FROM cvs");
            $rows =  $db->query($query);

            if ($rows && $rows->rowCount() > 0) {

        ?>
                <table cellspacing="0" cellpadding="5" id="myTable">
                    <tr>
                        <th align='left' style='padding-right: 30px '><b style="color: rgb(102, 139, 170)">Name</b></th>
                        <th align='left' style='padding-right: 20px'><b style="color: rgb(102, 139, 170)">Email</b></th>
                        <th align='left' style='padding-right: 40px'><b style="color: rgb(102, 139, 170)">Key Programming Language</b></th>
                    </tr>
            <?php
              
                while ($row =  $rows->fetch()) {
                    $currentID = $row['id'];
                    echo  "<td align='left' style='padding-right: 30px'>" . $row['name'] . "</td>";
                    echo  "<td align='left' style='padding-right: 20px'>" . $row['email'] . "</td>";
                    echo "<td align='left' style='padding-right: 40px'>" . $row['keyprogramming'] . "</td>";
                    echo "<td align='left'><a href='moredetails.php?cvID=$currentID' id='submit' style='font-size:15px'>More details</a></td></tr>\n ";
                }
                echo  '</table>';
            } else {
                echo  "<p>No  course in the list.</p>\n"; 
            }
        } catch (PDOexception $ex) {
            echo "Sorry, a database error occurred! <br>";
            echo "Error details: <em>" . $ex->getMessage() . "</em>";
        }
            ?>
    </div>


</body>

</html>