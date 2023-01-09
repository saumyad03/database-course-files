<?php
    if (isset($_POST["dependents"]) && $_POST["dependents"] == "Generate") {
        $server_name = "localhost";
        $user_name = "root";
        $password = "";
        $db_name = "bank";   
        $connection = mysqli_connect($server_name, $user_name, $password, $db_name);
        if (!$connection) {
            die("Unsucesssful database connection" . mysqli_connect_error());
        }
        $sql = "SELECT E.First
        FROM EMPLOYEE E
        WHERE E.SSN = ALL
            (SELECT D.Employee_SSN
            FROM DEPENDENT D);";
        $results = $connection->query($sql);
        $results->fetch_all(MYSQLI_ASSOC);
    }
    if (isset($_POST["himothy"]) && $_POST["himothy"] == "Generate") {
        $server_name = "localhost";
        $user_name = "root";
        $password = "";
        $db_name = "bank";   
        $connection = mysqli_connect($server_name, $user_name, $password, $db_name);
        if (!$connection) {
            die("Unsucesssful database connection" . mysqli_connect_error());
        }
        $sql = "SELECT A.Account_number
        FROM ACCOUNT A
        WHERE A.Account_number IN
            (SELECT H.Acct_number
            FROM CUSTOMER C, HOLDS H
            WHERE C.SSN = H.Customer_SSN AND C.First = 'Himothy');";
        $results = $connection->query($sql);
        $results->fetch_all(MYSQLI_ASSOC);
    }
?>
<?php if (isset($_POST["dependents"]) || isset($_POST["himothy"])) : ?>
    <?php if (isset($_POST["dependents"]) && $_POST["dependents"] == "Generate") : ?>
        <table>
            <thead>
                <th>Employee</th>
            </thead>
            <tbody>
                <?php foreach ($results as $result) : ?>
                        <tr>
                            <td><?php echo $result["First"] ?></td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (isset($_POST["himothy"]) && $_POST["himothy"] == "Generate") : ?>
        <table>
            <thead>
                <th>Account Number</th>
            </thead>
            <tbody>
                <?php foreach ($results as $result) : ?>
                        <tr>
                            <td><?php echo $result["Account_number"] ?></td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>
<form method="POST">
    <label for="submit1_btn">Retrieve the name of the employee who is responsible for all the dependents</label><br><br>
    <input id="submit1_btn" type="submit" name="dependents" value="Generate">
</form>
<form method="POST">
    <label for="submit2_btn">Retrieve the account numbers of all accounts held by a customer with the first name “Himothy”</label><br><br>
    <input id="submit2_btn" type="submit" name="himothy" value="Generate">
</form>