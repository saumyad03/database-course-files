<?php
    if (isset($_POST["counts"]) && $_POST["counts"] == "Generate") {
        $server_name = "localhost";
        $user_name = "root";
        $password = "";
        $db_name = "bank";   
        $connection = mysqli_connect($server_name, $user_name, $password, $db_name);
        if (!$connection) {
            die("Unsucesssful database connection" . mysqli_connect_error());
        }
        $sql = "SELECT C.First, COUNT(*) as Count
        FROM CUSTOMER C, HOLDS H
        WHERE C.SSN = H.Customer_SSN
        GROUP BY C.First";
        $results = $connection->query($sql);
        $results->fetch_all(MYSQLI_ASSOC);
    }
    if (isset($_POST["bankers"]) && $_POST["bankers"] == "Generate") {
        $server_name = "localhost";
        $user_name = "root";
        $password = "";
        $db_name = "bank";   
        $connection = mysqli_connect($server_name, $user_name, $password, $db_name);
        if (!$connection) {
            die("Unsucesssful database connection" . mysqli_connect_error());
        }
        $sql = "SELECT E.First, COUNT(*) as Count
        FROM CUSTOMER C, EMPLOYEE E
        WHERE C.Personal_banker_SSN = E.SSN
        GROUP BY E.First
        HAVING COUNT(*) > 2";
        $results = $connection->query($sql);
        $results->fetch_all(MYSQLI_ASSOC);
    }  

?>
<?php if (isset($_POST["counts"]) || isset($_POST["bankers"])) : ?>
    <?php if (isset($_POST["counts"]) && $_POST["counts"] == "Generate") : ?>
        <table>
            <thead>
                <th>Customer</th>
                <th>Number of Accounts</th>
            </thead>
            <tbody>
                <?php foreach ($results as $result) : ?>
                        <tr>
                            <td><?php echo $result["First"] ?></td>
                            <td><?php echo $result["Count"] ?></td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (isset($_POST["bankers"]) && $_POST["bankers"] == "Generate") : ?>
        <table>
            <thead>
                <th>Employee</th>
                <th>Number of Customers</th>
            </thead>
            <tbody>
                <?php foreach ($results as $result) : ?>
                        <tr>
                            <td><?php echo $result["First"] ?></td>
                            <td><?php echo $result["Count"] ?></td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>   
    <?php endif; ?>
<?php endif; ?>
<form method="POST">
    <label for="submit1_btn">Retrieve the names of customers along with how many accounts they hold</label><br><br>
    <input id="submit1_btn" type="submit" name="counts" value="Generate">
</form>
<form method="POST">
    <label for="submit2_btn">Retrieve the names of employees who are personal bankers for more than two customers</label><br><br>
    <input id="submit2_btn" type="submit" name="bankers" value="Generate">
</form>