<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="container">
    <div class="sidePanel">
        <div class="sidePanelHeader">
            <div class="containerCenter">
                <h2>SkyBatic</h2><br>
                <span>Administrācijas panelis</span>
            </div>
        </div>
        <div class="sidePanelMenu">
            <a href="../admin.php">Vadības panelis</a><br>
            <a href="amati.php" class="active">Amati</a>
            <a href="">Personals</a>
            <a href="">Lietotaji</a>
            <a href="">Darba uzdevumi</a>
            <a href="">Darba veidi</a>
            <a href="">Lauki</a>
            <a href="">Sezoni</a>
            <a href="">Kulturas</a>
            <a href="">Tehnika</a>
            <a href="">Aprikojums</a>
            <a href="">Ražotaji</a>
            <a href="">Darba tehnika</a>
            <a href="">Darba Aprikojums</a>
            <a href="../index.php" class="iziet">Iziet</a>
        </div>   
    </div>

    <div class="mainContent">
        <div class="mainContentHeader">
            <div>
                <span>Amati</span>
                <p>Šeit varat pārvaldīt amatus.</p>
            </div>
            <button onclick="location.href='save.php'">+ Pievienot jaunu</button>
        </div>

        <table>
            <tr>
                <th>Nosaukums</th>
                <th>Darbības</th>
            </tr>

            <?php 
            require_once '../../config/database.php';

            $sql = "SELECT * FROM amati";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr> 
                            <td>" . $row["Nosaukums"] . "</td>
                            <td>
                            <button onclick=\"location.href='read.php?id=".$row["Amats_ID"]."'\">Read</button>
                            <button onclick=\"location.href='update.php?id=".$row["Amats_ID"]."'\">Edit</button>
                            <button onclick=\"location.href='delete.php?id=".$row["Amats_ID"]."'\">Delete</button>
                            </tr>";
                }
            } else {
                echo "0 results";
            }

            mysqli_close($conn);

            ?>
        </table>


    </div>
    </div>
</body>
</html>