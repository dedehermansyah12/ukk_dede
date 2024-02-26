<?php
session_start();
include "../../config.php";
if (isset($_POST['nisn'])&& (isset($_POST['nama']))) {
  // Get user input
  $nama = $_POST['nama'];
  $nisn = $_POST['nisn'];

// Query to check user credentials
$query = "SELECT * FROM member WHERE nisn='$nisn' AND nama='$nama'";
$result = $connection->query($query);

if ($result->num_rows == 1) {
    // Login successful
    $_SESSION['nama'] = $nama;
    $_SESSION['nisn'] = $nisn;

    header("Location: ../../member/index.php"); // Redirect to dashboard or any other page
} else {
    // Login failed
    echo "<script>alert('nis, nama dan password Anda salah. Silahkan coba lagi!')</script>";
}
}
$connection->close();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../../assets/images/Madya_Perpus-removebg-preview.png" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form method="post">
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">NISN</label>
                    <input type="text" class="form-control" name="nisn" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control"  name="nama"  id="exampleInputtext1" aria-describedby="text">
                  </div>
                  <button class="btn btn-primary" type="submit" name="submit">Sign In</button>
                  <p>Don't have an account?<a href="sign_up.php" class="text-decoration-none text-primary"> Sign Up</a></p>
                  <p><a href="../../index.php" class="text-decoration-none text-primary"> Back</a></p>
                </div>
                  
           
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <?php if (isset($error)) : ?>
		<div class="alert alert-danger mt-2" role="alert">Nama / Nisn / Password tidak sesuai !
		</div>
	<?php endif; ?>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(() => {
			'use strict'

			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			const forms = document.querySelectorAll('.needs-validation')

			// Loop over them and prevent submission
			Array.from(forms).forEach(form => {
				form.addEventListener('submit', event => {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
		})()
	</script>
	<!-- partial -->

</body>

</html>