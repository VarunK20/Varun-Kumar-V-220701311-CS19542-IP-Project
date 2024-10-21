<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($db, $_POST['firstName']);
    $last_name = mysqli_real_escape_string($db, $_POST['lastName']);
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $blood_group = mysqli_real_escape_string($db, $_POST['bloodGroup']);
    $aadhar_number = mysqli_real_escape_string($db, $_POST['aadhar']);
    $phone_number = mysqli_real_escape_string($db, $_POST['phone']);
    $weight = mysqli_real_escape_string($db, $_POST['weight']);
    $last_donation = !empty($_POST['lastDonation']) ? mysqli_real_escape_string($db, $_POST['lastDonation']) : NULL;
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $checkUser = "SELECT * FROM donors WHERE username='$username'";
    $result = $db->query($checkUser);

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Username already exists. Please choose a different username.');
                window.location.href='signup.html';
              </script>";
    } else {
        $sql = "INSERT INTO donors (first_name, last_name, dob, gender, address, blood_group, aadhar_number, phone_number, weight, last_donation_date, username, password) 
                VALUES ('$first_name', '$last_name', '$dob', '$gender', '$address', '$blood_group', '$aadhar_number', '$phone_number', '$weight', " . ($last_donation ? "'$last_donation'" : "NULL") . ", '$username', '$password')";

        if ($db->query($sql) === TRUE) {
            echo "<script>
                    alert('Successfully registered!');
                    window.location.href='index.html';
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    }

    $db->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media (min-width: 1025px) {
            .h-custom {
                height: 100% !important;
            }
        }
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }
        .card-registration .select-arrow {
            top: 13px;
        }
        .gradient-custom-2 {
            background: linear-gradient(to right, rgb(155, 47, 47), rgb(195, 132, 113));
        }
        .bg-red {
            background-color: #a02a2a;
        }
        @media (min-width: 992px) {
            .card-registration-2 .bg-red {
                border-top-right-radius: 15px;
                border-bottom-right-radius: 15px;
            }
        }
        @media (max-width: 991px) {
            .card-registration-2 .bg-red {
                border-bottom-left-radius: 15px;
                border-bottom-right-radius: 15px;
            }
        }
    </style>
</head>
<body>
    <section class="h-100 h-custom gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <form action="signups.php" method="post">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <h3 class="fw-normal mb-5" style="color: #ff0000;">General Information</h3>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <input type="text" id="firstName" name="firstName" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="firstName">First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="lastName">Last Name</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="date" id="dob" name="dob" class="form-control form-control-lg" required />
                                                    <label class="form-label" for="dob">Date of Birth</label>
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <select name="age" required class="form-select form-select-lg">
                                                    <option value="" disabled selected>Age</option>
                                                    <option value="below_18">Below_18</option>
                                                    <option value="18_30">18-30</option>
                                                    <option value="31_45">31-45</option>
                                                    <option value="above_45">45 and above</option>
                                                </select>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <select name="gender" required class="form-select form-select-lg">
                                                    <option value="" disabled selected>Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="transgender">Transgender</option>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">
                                                    <div data-mdb-input-init class="form-outline">
                                                        <input type="text" id="address" name="address" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="address">Residential Address</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="nationality" required class="form-select form-select-lg">
                                                        <option value="" disabled selected>Nationality</option>
                                                        <option value="indian">Indian</option>
                                                        <option value="nri">NRI</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">
                                                    <p style="margin-top: 10px;">Already have an account?</p>
                                                    <button type="submit" class="btn btn-light btn-lg">Sign In</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 bg-red text-white">
                                        <div class="p-5">
                                            <h3 class="fw-normal mb-5">Personal Details</h3>

                                            <div class="mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline form-white">
                                                    <input type="text" id="aadhar" name="aadhar" class="form-control form-control-lg" required />
                                                    <label class="form-label" for="aadhar">Aadhar Number</label>
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
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

                                            <div class="row">
                                                <div class="col-md-5 mb-4 pb-3">
                                                    <div data-mdb-input-init class="form-outline form-white">
                                                        <input type="text" id="weight" name="weight" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="weight">Weight (kg)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 mb-4 pb-2">
                                                    <div data-mdb-input-init class="form-outline form-white">
                                                        <input type="text" id="illness" name="illness" class="form-control form-control-lg" />
                                                        <label class="form-label" for="illness">Recent Illness or Travel History</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline form-white">
                                                    <input type="date" id="lastDonation" name="lastDonation" class="form-control form-control-lg" />
                                                    <label class="form-label" for="lastDonation">Last Donation Date</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-5 mb-4 pb-2">
                                                    <div data-mdb-input-init class="form-outline form-white">
                                                        <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="username">Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 mb-4 pb-2">
                                                    <div data-mdb-input-init class="form-outline form-white">
                                                        <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="password">Password</label>
                                                    </div>
                                                    <div data-mdb-input-init class="form-outline form-white">
                                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="confirmPassword">Re-enter Password</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div data-mdb-input-init class="form-outline form-white">
                                                    <input type="text" id="phone" name="phone" class="form-control form-control-lg" placeholder="+91XXXXXXXXXX" required />
                                                    <label class="form-label" for="phone">Phone Number</label>
                                                </div>
                                            </div>

                                            <div class="form-check d-flex justify-content-start mb-4 pb-3">
                                                <input class="form-check-input" type="checkbox" value="" id="termsCheck" required />
                                                <label class="form-check-label" for="termsCheck">
                                                     I agree to the <a href="#!" class="text-white"><u>terms and conditions</u></a>
                                                </label>
                                            </div>

                                            <button type="submit" class="btn btn-light btn-lg">Register</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
