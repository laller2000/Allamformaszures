<!DOCTYPE html>
<?php
header('Content-Type: text/html; charset="utf-8"');
$servername="localhost";
$username="root";
$password="";
$dbname="orszagok";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Csatlakozás hiba". $conn->connect_error);
}
$conn->set_charset("uft-8");
$allamforma= filter_input(INPUT_POST,"allamforma", FILTER_SANITIZE_STRING);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="hu"/>
        <title>Államforma</title>
        <link rel="stylesheet" type="text/css" href="Allamforma.css"/>
    </head>
    <body>
        <div id="content">
            <h1>Államforma adatai</h1>
            <div>
                <form method="POST">
                    <select name="allamforma" id="allamforma">
                        <?php
                        $sql="SELECT DISTINCT `allamforma` FROM `orszagok` ORDER By 1";
                        $result=$conn->query($sql);
                        if($result->num_rows>0)
                        {
                            while($row=$result->fetch_assoc())
                            {
                                echo '<option value="'.$row["allamforma"].'">'.$row["allamforma"].'</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" value="Szűrés"/>
                </form>   
            </div>
        <?php
        if(strlen($allamforma)>0)
        {
            $sql='SELECT `id`,`orszag`,`kontinens`,`allamforma`,`nepesseg`,`nep_fovaros`,`autojel`,`country`,`capital`,`penznem`,`penzjel`,`valtopenz`,`telefon`,`gdp`,`kat` FROM `orszagok` WHERE `allamforma` LIKE"'.$allamforma.'";';
        }else
        {
            $sql= "SELECT `id`,`orszag`,`kontinens`,`allamforma`,`nepesseg`,`nep_fovaros`,`autojel`,`country`,`capital`,`penznem`,`penzjel`,`valtopenz`,`telefon`,`gdp`,`kat` FROM `orszagok` WHERE  1";

        }
        
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
            ?>
        <table>
            <tr>
            <th>id</th>
            <th>orszag</th>
            <th>kontinens</th>
            <th>allamforma</th>
            <th>nepesseg</th>
            <th>nepfovaros</th>
            <th>autojel</th>
            <th>country</th>
            <th>capital</th>
            <th>penznem</th>
            <th>penzjel</th>
            <th>valtopenz</th>
            <th>telefon</th>
            <th>gdp</th>
            </tr>
        
            <?php
            while($row=$result->fetch_assoc())
            {
                echo "<tr><td>".$row["id"]."</td>";
                echo "<td>".$row["orszag"]."</td>";
                echo "<td>".$row["kontinens"]."</td>";
                echo "<td>".$row["allamforma"]."</td>";
                echo "<td>".$row["nepesseg"]."</td>";
                echo "<td>".$row["autojel"]."</td>";
                echo "<<td>".$row["country"]."</td>";
                echo "<td>".$row["capital"]."</td>";
                echo "<td>".$row["penznem"]."</td>";
                echo "<td>".$row["penzjel"]."</td>";
                echo "<td>".$row["valtopenz"]."</td>";
                echo "<td>".$row["telefon"]."</td>";
                echo "<td>".$row["gdp"]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }else
        {
            echo '0 eredmeny';
        }
        $conn->close();
        ?>
       </div> 
    </body>
</html>
