<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_group = mysqli_real_escape_string($db, $_POST['bloodGroup']);
    $address = mysqli_real_escape_string($db, $_POST['location']);
    $age_group = mysqli_real_escape_string($db, $_POST['age']);

    $sql = "SELECT * FROM donors WHERE blood_group = '$blood_group' AND address LIKE '%$address%' AND age_group = '$age_group'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $donors = [];
        while ($row = $result->fetch_assoc()) {
            $donors[] = $row;
        }
        echo "<script>
                localStorage.setItem('donors', JSON.stringify(" . json_encode($donors) . "));
                window.location.href = 'found.html';
              </script>";
    } else {
        echo "<script>
                alert('No donors found matching the criteria.');
                window.location.href = 'find-donors.php';
              </script>";
    }

    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .gradient-custom-2 {
            background: linear-gradient(to right, rgb(155, 47, 47), rgb(195, 132, 113));
            height: 100% !important;
            display: flex; 
            align-items: center; 
        }
        .container {
            height: 100%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .card {
            border-radius: 15px;
            width: 100%; 
        }
        .btn-primary {
            background-color: #ff3e3e;
            border-color: #ff3e3e;
        }
        .btn-primary:hover {
            background-color: #e63232;
            border-color: #e63232;
        }
    </style>
</head>
<body>
    <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row justify-content-center h-100">
                <div class="col-lg-12 justify-content-center"> <!-- Centered column -->
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center mb-8 text-black">Find Donors</h3>
                            <form action="find-donors.php" method="post">
                                <div class="mb-3">
                                    <select name="bloodGroup" required class="form-select form-select-lg">
                                        <option value="" disabled selected>Blood Group</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="location" class="form-control form-control-lg" placeholder="Location (e.g., city, state)" required />
                                </div>
                                <div class="mb-3">
                                    <select name="age" required class="form-select form-select-lg">
                                        <option value="" disabled selected>Age Category</option>
                                        <option value="Below 18">Below 18</option>
                                        <option value="18-30">18-30</option>
                                        <option value="31-45">31-45</option>
                                        <option value="45 and above">45 and above</option>
                                    </select>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
