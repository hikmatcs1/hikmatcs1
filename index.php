<?php
$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Penerimaan Mahasiswa Baru</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <a href="index.php">
    <img src="img/logo.png" alt="Logo Kampus">
    </a>
    <h1>Penerimaan Mahasiswa Baru</h1>
  </header>

  <?php if ($success == '1'): ?>
    <div style="color: green; text-align: center; margin: 1rem;">
      Pendaftaran berhasil! Terima kasih telah mendaftar.
    </div>
  <?php elseif ($error == '1'): ?>
    <div style="color: red; text-align: center; margin: 1rem;">
      Mohon isi semua data wajib dengan benar.
    </div>
  <?php elseif ($error == '2'): ?>
    <div style="color: red; text-align: center; margin: 1rem;">
      NIK sudah terdaftar. Silakan gunakan NIK lain.
    </div>
  <?php endif; ?>

  <nav>
    <ul>
      <li><a href="#about">Tentang</a></li>
      <li><a href="#info">Informasi Pendaftaran</a></li>
      <li><a href="#form">Daftar Sekarang</a></li>
      <li><a href="#chart">Grafik Pendaftar</a></li>
      <li><a href="login.php">Login</a></li>
    </ul>
  </nav>

  <main>
    <section id="about">
      <h2>Tentang Penerimaan Mahasiswa Baru</h2>
      <p>Selamat datang di halaman resmi Penerimaan Mahasiswa Baru.</p>
      <p>Proses pendaftaran dilakukan secara online dengan mudah dan cepat.</p>
    </section>

    <section id="info">
      <h2>Informasi Pendaftaran</h2>
      <table>
        <thead>
          <tr>
            <th>Gelombang</th>
            <th>Biaya Pendaftaran</th>
            <th>Jadwal Pendaftaran</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Gelombang 1</td>
            <td>Rp 200.000</td>
            <td>1 Januari - 30 Juni 2025</td>
          </tr>
          <tr>
            <td>Gelombang 2</td>
            <td>Rp 300.000</td>
            <td>1 Juli - 15 September 2025</td>
          </tr>
          <tr>
            <td>Gelombang 3</td>
            <td>Rp 350.000</td>
            <td>1 Oktober - 10 Desember 2025</td>
          </tr>
        </tbody>
      </table>
      <p>Hubungi <a href="mailto:info@kampus.ac.id">info@kampus.ac.id</a> atau (021) 2345 6789.</p>
    </section>

    <section id="form">
      <h2>Formulir Pendaftaran</h2>
      <form id="registration-form" action="proses.php" method="POST" novalidate>
        <label for="nik">NIK</label>
        <input type="text" id="nik" name="nik" placeholder="Masukkan NIK" required>

        <label for="nisn">NISN</label>
        <input type="text" id="nisn" name="nisn" placeholder="Masukkan NISN" required>

        <label for="fullname">Nama Lengkap</label>
        <input type="text" id="fullname" name="fullname" placeholder="Masukkan nama lengkap Anda" required>

        <label for="sekolah">Asal Sekolah</label>
        <input type="text" id="sekolah" name="sekolah" placeholder="Masukkan Asal Sekolah" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="contoh@domain.com" required>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap Anda" required></textarea>

        <label for="kabupaten_kota">Kabupaten / Kota</label>
        <select id="kabupaten_kota" name="kabupaten_kota" required>
          <option value="" disabled selected>-- Pilih Kabupaten/Kota --</option>
          <option value="Kabupaten Tangerang">Kabupaten Tangerang</option>
          <option value="Kabupaten Serang">Kabupaten Serang</option>
          <option value="Kota Serang">Kota Serang</option>
          <option value="Kabupaten Pandeglang">Kabupaten Pandeglang</option>
          <option value="Kabupaten Lebak">Kabupaten Lebak</option>
          <option value="Kota Cilegon">Kota Cilegon</option>
        </select>

        <label for="phone">Nomor Telepon</label>
        <input type="tel" id="phone" name="phone" pattern="^\d{9,12}$" placeholder="Masukkan nomor telepon" required>

        <label for="program">Program Studi</label>
        <select id="program" name="program" required>
          <option value="" disabled selected>-- Pilih Program Studi --</option>
          <option value="Teknik Informatika">Teknik Informatika</option>
          <option value="Teknik Mesin">Teknik Mesin</option>
          <option value="Sistem Informasi">Sistem Informasi</option>
          <option value="Manajemen">Manajemen</option>
          <option value="Akuntansi">Akuntansi</option>
        </select>

        <button type="submit">Kirim Pendaftaran</button>
      </form>

      <div id="form-message" style="margin-top:1rem; font-weight:600;"></div>
    </section>

    <section id="chart">
      <h2>Grafik Pendaftar berdasarkan Wilayah</h2>
      <canvas id="pendaftarChart" role="img" aria-label="Grafik Pendaftar per Kabupaten">
        Browser Anda tidak mendukung elemen canvas.
      </canvas>
    </section>

    <section id="chart-prodi">
      <h2>Grafik Pendaftar berdasarkan Program Studi</h2>
      <canvas id="programChart" role="img" aria-label="Grafik Program Studi">
        Browser Anda tidak mendukung elemen canvas.
      </canvas>
    </section>
  </main>

  <footer>
    &copy; 2024 Kampus Swasta Serang
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    fetch('grafik.php')
      .then(res => res.json())
      .then(data => {
        const ctx = document.getElementById('pendaftarChart').getContext('2d');
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: Object.keys(data),
            datasets: [{
              label: 'Jumlah Pendaftar',
              data: Object.values(data),
              backgroundColor: 'rgba(59, 130, 246, 0.7)',
              borderColor: 'rgba(59, 130, 246, 1)',
              borderWidth: 2,
              borderRadius: 6
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: false }
            },
            scales: {
              y: {
                beginAtZero: true,
                ticks: { stepSize: 10 }
              }
            }
          }
        });
      });

    fetch('grafik_prodi.php')
      .then(res => res.json())
      .then(data => {
        const ctxProdi = document.getElementById('programChart').getContext('2d');
        new Chart(ctxProdi, {
          type: 'pie',
          data: {
            labels: Object.keys(data),
            datasets: [{
              data: Object.values(data),
              backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)'
              ],
              borderColor: '#fff',
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' }
            }
          }
        });
      });
    const form = document.getElementById("registration-form");
    const message = document.getElementById("form-message");

    form.addEventListener("submit", function (e) {
      message.textContent = "";
      if (!form.checkValidity()) {
        e.preventDefault();
        message.style.color = "#dc2626";
        message.textContent = "Mohon isi semua data wajib dengan benar.";
        return;
      }

      const phone = form.phone.value.trim();
      const phoneRegex = /^\d{9,12}$/;

      if (!phoneRegex.test(phone)) {
        e.preventDefault();
        message.style.color = "#dc2626";
        message.textContent = "Nomor telepon harus berupa angka dan 9–12 digit.";
        form.phone.focus();
      }
    });
  </script>
</body>
</html>
