<?php
include "koneksi.php";
$mandiri=query("SELECT * FROM mandiri");

// Pagination setup
$limit = 10; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;
// Pencarian berdasarkan nama
$search = isset($_GET['nama']) ? $_GET['nama'] : '';
$whereClause = $search ? "WHERE nama LIKE '%$search%'" : '';
// Query untuk mendapatkan data
$totalQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM mandiri $whereClause");
$totalData = mysqli_fetch_assoc($totalQuery)['total'];
$totalPages = ceil($totalData / $limit);
$query = "SELECT * FROM mandiri $whereClause LIMIT $start, $limit";
$mandiri = query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kunjungi - Modifikasi Pemesanan</title>

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/flat-icon/font/flaticon.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
    .table-custom {
      background-color: white;
      color: #333;
      width: 100%;
    }
    .table-custom thead th {
      background-color: #6059f6;
      color: white;
      text-align: center;
    }
    .table-custom td, .table-custom th {
      text-align: center;
      vertical-align: middle;
    }
    .table-custom .btn-icon {
      padding: 0;
      margin: 0;
      border: none;
      background: transparent;
      font-size: 16px;
    }
    .table-custom .btn-icon i {
      font-size: 18px;
      margin: 0;
    }
    .table-custom .btn-warning i {
      color: #ffc107; /* Warna kuning untuk ikon Ubah */
    }
    .table-custom .btn-danger i {
      color: #dc3545; /* Warna merah untuk ikon Hapus */
    }
    .table-custom .btn-icon:hover {
      color: #6059f6;
    }
    .pagination-custom .page-link {
      color: #6059f6;
    }
    .pagination-custom .page-item.active .page-link {
      background-color: #6059f6;
      border-color: #6059f6;
    }

    .search-bar-wrapper {
      display: flex;
      justify-content: flex-start;
      margin-bottom: 20px;
    }

    .search-bar-wrapper form {
      display: flex;
      align-items: center; 
    }

    .search-bar {
      border: 1px solid #6059f6;
      border-radius: 20px;
      padding: 5px 15px;
      width: 250px;
      margin-right: -40px; 
    }

    .btn-cari {
      background-color: #6059f6;
      color: white;
      border-radius: 20px;
      padding: 5px 15px;
      border: none;
      margin-left: -8px;
    }

    .btn-cari i {
      font-size: 16px;
    }

    .showing-info {
      font-size: 14px;
      color: #6059f6;
      text-align: center;
      margin-bottom: 10px;
    }
  </style>

</head>
<script>
  function confirmDelete() {
    return confirm("Apakah Anda yakin ingin menghapus data tersebut?");
  }
</script>
<body>

  <!--================ Header Menu Area start =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620 justify-content-center">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav">
              <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li> 
              <li class="nav-item"><a class="nav-link" href="destinasi.php">Informasi Destinasi</a></li> 
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Pemesanan</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="paket.php">Jelajah Paketan</a></li>
                  <li class="nav-item"><a class="nav-link" href="mandiri.php">Jelajah Mandiri</a></li>
                </ul>
              </li>
              <li class="nav-item submenu dropdown active">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Modifikasi Pemesanan</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="modifikasi.php">Jelajah Paketan</a></li>
                  <li class="nav-item"><a class="nav-link" href="modifikasi_mandiri.php">Jelajah Mandiri</a></li>
                </ul>
              </li>
            </ul>
          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->

  <!--================Blog section Start =================-->
  <section class="section-padding bg-gray">
    <div class="container">
      <div class="section-intro text-center">
        <h2>Modifikasi Pemesanan Mandiri</h2>
        <p>Butuh cek kembali pesananmu? Yuk, modifikasi ulang sebelum liburanmu dimulai!</p>
      </div>
      <br/>
      <!-- search bar -->
      <div class="search-bar-wrapper">
        <form action="modifikasi_mandiri.php" method="get">
          <input type="text" name="nama" class="form-control search-bar" placeholder="Cari pesanan..." value="<?php echo htmlspecialchars($search); ?>">
          <button type="submit" class="btn btn-cari"><i class="fas fa-search"></i></button>
        </form>
      </div>      
    <!-- Table -->
      <div class="table-responsive">
        <table class="table table-hover table-custom">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jumlah Orang</th>
              <th>Tanggal Pemesanan</th>
              <th>Durasi Liburan</th>
              <th>Resort</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($mandiri)): ?>
            <?php $id=1; ?>
            <?php foreach ($mandiri as $row): ?>
              <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $row["nama"]; ?></td>
                <td><?php echo $row["jumlah"]; ?></td>
                <td><?php echo $row["tanggal_pemesanan"]; ?></td>
                <td><?php echo $row["durasi"]; ?></td>
                <td><?php echo $row["resort"]; ?></td>
                <td><?php echo $row["harga"]; ?></td>
                <td>
                  <a href="edit_mandiri.php?id=<?php echo $row['id_mandiri']; ?>" class="btn btn-icon btn-warning"><i class="fas fa-edit"></i></a>
                  <a href="hapus_mandiri.php?id=<?php echo $row['id_mandiri']; ?>" class="btn btn-icon btn-danger" onclick="return confirmDelete();"><i class="fas fa-trash-alt"></i></a>                
                </td>
                </tr>
            <?php $id++; ?>
            <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="10">Tidak ada data yang tersedia.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    <!-- Pagination -->
    <div class="showing-info">
      Menampilkan <?php echo $start + 1; ?> sampai <?php echo min($start + $limit, $totalData); ?> dari <?php echo $totalData; ?> data
    </div>
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center pagination-custom">
        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $page - 1; ?>&nama=<?php echo $search; ?>" tabindex="-1">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>&nama=<?php echo $search; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $page + 1; ?>&nama=<?php echo $search; ?>">Next</a>
        </li>
      </ul>
    </nav>
    </div>
  </section>
  <!--================Blog section End =================-->

  <!-- ================ start footer Area ================= -->
  <footer class="footer-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Portal Wisata Generasi Petualang Batam</h6>
            <p>
            Selamat datang di Portal Wisata Generasi Petualang Batam, tempatnya para petualang muda menemukan destinasi seru dan spot-spot hits di Batam! Kami siap menemani setiap langkah petualanganmu.</p>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="single-footer-widget">
            <h6>Navigasi Link</h6>
            <div class="row">
              <div class="col">
                <ul>
                  <li><a href="index.php">Beranda</a></li>
                  <li><a href="destinasi.php">Informasi Destinasi</a></li>
                  <li><a href="paket.php">Pemesanan Jelajah Paket</a></li>
                  <li><a href="mandiri.php">Pemesanan Jelajah Mandiri</a></li>
                  <li><a href="modifikasi.php">Modifikasi Pemesanan Paket</a></li>
                  <li><a href="modifikasi_mandiri.php">Modifikasi Pemesanan Mandiri</a></li>
                </ul>
              </div>
            </div>							
          </div>
        </div>							
      </div>
      <div class="footer-bottom">
        <div class="row align-items-center">
          <p class="col-lg-8 col-sm-12 footer-text m-0 text-center text-lg-left">This website is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a> and <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
          <div class="col-lg-4 col-sm-12 footer-social text-center text-lg-right">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- ================ End footer Area ================= -->

  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/skrollr.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
