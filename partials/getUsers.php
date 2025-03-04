
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "appointment";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchTerm = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';

    $sql = "SELECT appointmentId AS ID, CONCAT(firstName, ' ', IFNULL(middleName, ''), ' ', lastName) AS Name, position AS Position, address AS Address, primaryEmail AS Email FROM users";
    $result = $conn->query($sql);

    echo '<script>';
    echo 'var db = { clients: [';

    if ($result->num_rows > 0) {
        $clients = [];
        while ($row = $result->fetch_assoc()) {
            $clients[] = json_encode($row);
        }
        echo implode(',', $clients);
    }

    echo '] };';
    echo '</script>';

    $conn->close();
?>

<script>
    $(function () {
        $.ajax({
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $("#jsGrid1").jsGrid({
                    height: "100%",
                    width: "100%",

                    sorting: true,
                    paging: true,

                    data: db.clients,

                    fields: [
                        { name: "ID", type: "text", width: 50 },
                        { name: "Name", type: "text", width: 150 },
                        { name: "Position", type: "text", width: 100 },
                        { name: "Address", type: "text", width: 200 },
                        { name: "Email", type: "email", title: "Contact Info" }
                    ]
                });

            },
            error: function (err) {
                console.log("Error: ", err);
            }
        });

        $(".jsgrid-header-cell").on("click", function (e) {
            e.stopPropagation();
        });
        $(".jsgrid-pager").on("click", function (e) {
            e.stopPropagation();
        });
    })
</script>