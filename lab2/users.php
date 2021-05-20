<?php
session_start();
if(!isset($_SESSION["admin"]) || $_SESSION["admin"]!=true){ //Check if the session already exist
    die();
}
include("mysql.php");
$result = pull();
$users = mysqli_fetch_assoc($result);
?>
<table>
    <thead>
        <tr>
            <th>username</th>
            <th>password</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            while ($users != null) {
                print("<tr>");
                foreach ($users as $key => $val) {
                    print("<th>$val</th>");
                }
                print("</tr>");
                $users = mysqli_fetch_assoc($result);

            }

        ?>
    </tbody>
</table>
<?php
close_connection();
?>