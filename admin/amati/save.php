<?php
    require_once '../../config/database.php';

    $nosaukums = "";
    $nosaukums_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_nosaukums = trim($_POST["nosaukums"]);
        if (empty($input_nosaukums)) {
            $nosaukums_err = "Lūdzu, ievadiet nosaukumu.";
        } elseif (!filter_var($input_nosaukums, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $nosaukums_err = "Lūdzu, ievadiet derīgu nosaukumu.";
        } else {
            $nosaukums = $input_nosaukums;
        }

        if (empty($nosaukums_err)) {
            $sql = "INSERT INTO amati (Nosaukums) VALUES(?)";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_nosaukums);
                $param_nosaukums = $nosaukums;

                if (mysqli_stmt_execute($stmt)) {
                    header("location: amati.php");
                    exit();
                } else {
                    echo "Ups! Kaut kas nogāja greizi. Lūdzu, mēģiniet vēlreiz vēlāk.";
                }

            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Izveidot ierakstu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Izveidot ierakstu</h2>
                    <p>Lūdzu, aizpildiet šo veidlapu un iesniedziet to, lai pievienotu darbinieka ierakstu datubāzei.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nosaukums</label>
                            <input type="text" name="nosaukums" class="form-control <?php echo (!empty($nosaukums_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nosaukums; ?>">
                            <span class="invalid-feedback"><?php echo $nosaukums_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Iesniegt">
                        <a href="amati.php" class="btn btn-secondary ml-2">Atcelt</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>