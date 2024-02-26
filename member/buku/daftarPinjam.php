<?php
// Start the session
session_start();

// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['nama'])) {
  header("Location: ../../sign/member/sign_in.php");
  exit();
}

if (!isset($_SESSION['nisn'])) {
  header("Location: ../../sign/member/sign_in.php");
  exit();
}

// Access the NIS from the session
$nisn = $_SESSION['nisn'];

// Now you can use $nis wherever you need it

require "../../config.php";
pengembalian();
$itemsPerPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;
// Assuming $id is the specific value you want to match
$statusArray = [0, 1, 2];
$statusString = implode(',', $statusArray);  // Mengubah array menjadi string terpisah koma
$peminjaman = queryReadData("SELECT peminjaman.id AS peminjaman_id,
buku.cover AS cover,
buku.id_buku AS id_buku, 
buku.judul AS judul,
member.nisn AS nisn, 
member.nama AS nama, 
user.username AS username,
user.telp AS telp,
peminjaman.tgl_pinjam AS tgl_pinjam,
peminjaman.tgl_kembali AS tgl_kembali,
peminjaman.harga AS harga,
peminjaman.status AS status
FROM peminjaman
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN member ON peminjaman.nisn = member.nisn
INNER JOIN user ON peminjaman.id_user = user.id
WHERE peminjaman.nisn = $nisn and status IN ($statusString)
order by peminjaman.status DESC LIMIT $offset, $itemsPerPage");
$totalItems = queryReadData("SELECT COUNT(*) AS total FROM buku")[0]['total'];
$totalPages = ceil($totalItems / $itemsPerPage);
if (isset($_POST["search"])) {
  $peminjaman = searchPinjamMember($_POST["keyword"]);
}
// Replace $id with the actual condition you want to use in the WHERE clause
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <title>Transaksi peminjaman Buku || Member</title>
</head>
<style>
 body {
  background-color: #ffffff;
}
  
</style>

<body>
  <nav class="navbar">
    <div class="container">

      <div class="navbar-header">
        <button class="navbar-toggler" data-toggle="open-navbar1">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <img src="../../assets/images/Madya_Perpus-removebg-preview.png" style="width: 100px; height: 50px;">
        </a>
      </div>

      <div class="navbar-menu" id="open-navbar1">
        <ul class="navbar-nav">
          <li><a href="../index.php">Dashboard</a></li>
          <li><a href="daftarBuku.php">Daftar Buku </a></li>
          <li><a href="historyBuku.php">History</a></li>
          <li><a href="../logout.php">Log Out</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="p-4 mt-2">
    <div class="mt-2 alert alert-light" role="alert">Riwayat transaksi Peminjaman Buku Anda - <span class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["nama"]); ?></span></div>
    <?php
            $alertDisplayed = false;

            foreach ($peminjaman as $item) :
              if ($item['status'] == 0 && !$alertDisplayed) {
            ?>
                <div class="alert alert-danger">
                  <strong>Pemberitahuan!</strong> Silahkan kirim bukti transaksi ke nomor yang tertera.
                </div>
            <?php
                $alertDisplayed = true; // Set variabel ini menjadi true agar alert hanya ditampilkan sekali.
              }
            endforeach;?>
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 offset-md-6">
              <form action="" method="post" class="d-flex">
                <div class="input-group">
                  <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="Cari nisn atau nama..." aria-label="Search">
                  <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </div>
              </form>
            </div>
          </div>
          
    <div class="card mt-2">
      <div class="table-responsive text-nowrap">
    
        <table class="table table-striped table-hover">
          <thead class="text-center">
            <tr class="text-center" style="vertical-align: middle;">
            <th>No</th>
              <th>Cover</th>
              <th>Judul Buku</th>
              <th>NISN</th>
              <th>Nama Peminjam</th>
              <th>Petugas</th>
              <th>No Hp</th>
              <th>Harga Bayar</th>
              <th>Tgl. Pinjam</th>
              <th>Tgl. Selesai</th>
              <th width="160">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
                $no = 1; // Nomor urut dimulai dari 1
                $totalHarga = 0; // Inisialisasi total harga
                if (isset($peminjaman) && is_array($peminjaman) && count($peminjaman) > 0) {
                  foreach ($peminjaman as $item) :
                     // Menghapus karakter non-angka seperti "Rp." dan "."
                     $hargaBuku = floatval(preg_replace("/[^0-9]/", "", $item['harga']));
                     $totalHarga += $hargaBuku; // Menambahkan harga buku ke total
                ?>

                <tr class="text-center" style="vertical-align: middle;">
                <td><?= $no++; ?></td>
                  <td >
                    <img src="../../assets/imgDB/<?= $item['cover']; ?>" alt="" width="70px" height="100px" style="border-radius: 5px;">
                  </td>
                  <td><?= $item["judul"]; ?></td>
                  <td><?= $item["nisn"]; ?></td>
                  <td><?= $item["nama"]; ?></td>
                  <td><?= $item["username"]; ?></td>
                  <td><?= $item["telp"]; ?></td>
                  <td><?= $item["harga"]; ?></td>
                  <td><?= $item["tgl_pinjam"]; ?></td>
                  <td><?= $item["tgl_kembali"]; ?></td>
                  <td>
                  <?php
                        if ($item['status'] == '0') {
                          echo '<b class="badge bg-warning">Menunggu Persetujuan</b>';
                          ?>
                          <a href="batalPinjam.php?id=<?= $item['peminjaman_id']; ?>" class="btn btn-danger mt-2" style="width:100px;" onclick="return confirm('Apakah anda ingin membatalkan peminjaman ini?');"> Batalkan</a>
                          <?php
                        } elseif ($item['status'] == '1') {
                        ?>
                        <div>
                      <a href="bacaBuku.php?id_buku=<?= $item['id_buku']; ?>" class="btn btn-primary" style="width: 130px;"><i class="fas fa-book-open"></i> Baca</a>
                    </div>
                      <div>
                      <a href="kembalikan.php?id=<?= $item['peminjaman_id']; ?>" class="btn btn-success mt-1" style="width: 130px;">kembalikan</a>
                    </div>
                    <?php
                    }
                    if ($item['status'] == '2') {
                      echo '<b class="badge bg-danger">Tidak Disetujui</b>';
                    }
                    ?>
                    
                  </td>
                </tr>
            <?php endforeach;
            } else {
              echo '<tr><td colspan="10">Tidak ada data peminjaman.</td></tr>';
            } ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
            <strong>Total Harga: </strong>
            Rp. <?= number_format($totalHarga, 0, ',', '.'); ?>
          </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                      <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                  <?php endfor; ?>
                </ul>
              </nav>
            </div>



</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../../assets/js/script.js"></script>

</html>