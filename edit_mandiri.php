<?php
include "koneksi.php";

// Mengambil ID dari URL
$id_mandiri = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Mengambil data berdasarkan ID
$sql = "SELECT * FROM mandiri WHERE id_mandiri = $id_mandiri";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nomor_telp = $_POST['nomor_telp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $jumlah = $_POST['jumlah'];
    $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
    $resort = $_POST['resort'];
    $durasi = $_POST['durasi'];
    $tambahan = isset($_POST['tambahan']) ? $_POST['tambahan'] : array();

    // Menghitung harga awal berdasarkan jumlah orang dan durasi
    $harga = $jumlah * $durasi * 500000; 

    // Menambah harga berdasarkan tambahan
    if (in_array("Penginapan", $tambahan)) {
        $harga += 1000000;
    }
    if (in_array("Transportasi", $tambahan)) {
        $harga += 1200000;
    }
    if (in_array("Makanan", $tambahan)) {
        $harga += 500000;
    }

    // Update data ke database
    $sql = "UPDATE mandiri SET 
            nama='$nama', 
            nomor_telp='$nomor_telp', 
            email='$email', 
            alamat='$alamat', 
            jumlah='$jumlah', 
            tanggal_pemesanan='$tanggal_pemesanan', 
            resort='$resort', 
            durasi='$durasi', 
            tambahan='" . implode(", ", $tambahan) . "', 
            harga='$harga' 
            WHERE id_mandiri=$id_mandiri";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location='modifikasi_mandiri.php';</script>";
    } else {
        echo "<script>alert('Data gagal diperbarui'); window.location='edit_mandiri.php?id=$id_mandiri';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kunjungi - Pemesanan</title>
  <!-- <link rel="icon" href="img/Fevicon.png" type="image/png"> -->

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/flat-icon/font/flaticon.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">

  <link rel="stylesheet" href="css/style.css">

</head>
<body class="">

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
              <li class="nav-item submenu dropdown">
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
      <h2>Form Pemesanan Mandiri</h2>
      <p>Siap untuk berpetualang? Yuk, isi form ini dan jadikan liburan impianmu kenyataan!</p>
      <br/>
      <form class="search-form" method="post">
            <div class="form-group text-left">
              <label>Nama</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                </div>
            </div>
            <div class="form-group text-left">
              <label>Nomor Telephone</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nomor_telp" value="<?php echo htmlspecialchars($data['nomor_telp']); ?>" required>
                </div>
            </div>
            <div class="form-group text-left">
              <label>Email</label>
                <div class="input-group">
                  <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                </div>
            </div>
            <div class="form-group text-left">
              <label>Alamat</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="alamat" value="<?php echo htmlspecialchars($data['alamat']); ?>" required>
                </div>
            </div>
            <div class="form-group text-left">
              <label>Peserta</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="jumlah" value="<?php echo htmlspecialchars($data['jumlah']); ?>" required>
                </div>
            </div>
            <div class="form-group text-left">
              <label>Tanggal Pemesanan</label>
                <div class="input-group">
                  <input type="date" class="form-control" name="tanggal_pemesanan" value="<?php echo htmlspecialchars($data['tanggal_pemesanan']); ?>" required>
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="ti-notepad"></i></span>
                  </div>
                </div>
            </div>
            <div class="form-group text-left">
              <label>Resort</label>
                <select class="form-control" name="resort" required>
                  <option value="" disabled selected>Pilih Resort</option>
                  <option value="Panbil Nature Reserve" <?php echo ($data['resort'] == 'Panbil Nature Reserve') ? 'selected' : ''; ?>>Panbil Nature Reserve</option>
                  <option value="Nongsa Point Marina" <?php echo ($data['resort'] == 'Nongsa Point Marina') ? 'selected' : ''; ?>>Nongsa Point Marina</option>
                  <option value="Nuvasa" <?php echo ($data['resort'] == 'Nuvasa') ? 'selected' : ''; ?>>Nuvasa</option>
                </select>
            </div>
            <div class="form-group text-left">
              <label>Durasi Liburan</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="durasi" value="<?php echo htmlspecialchars($data['durasi']); ?>" required>
                </div>
            </div>
            <div class="form-group text-left">
                <label>Pilih Tambahan:</label><br/>
                <input type="checkbox" name="tambahan[]" value="Penginapan" <?php echo in_array('Penginapan', explode(", ", $data['tambahan'])) ? 'checked' : ''; ?>> Penginapan (Rp. 1.000.000)<br/>
                <input type="checkbox" name="tambahan[]" value="Transportasi" <?php echo in_array('Transportasi', explode(", ", $data['tambahan'])) ? 'checked' : ''; ?>> Transportasi (Rp. 1.200.000)<br/>
                <input type="checkbox" name="tambahan[]" value="Makanan" <?php echo in_array('Makanan', explode(", ", $data['tambahan'])) ? 'checked' : ''; ?>> Makanan (Rp. 500.000)<br/>
            </div>
            <button type="submit" class="button border-0 mt-3">Ubah</button>
        </form>
      </div>
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