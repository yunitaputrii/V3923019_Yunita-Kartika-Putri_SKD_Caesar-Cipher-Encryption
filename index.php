<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Menentukan karakter encoding halaman sebagai UTF-8 -->
    <meta charset="UTF-8">
    <!-- Menjamin kompatibilitas dengan versi terbaru Internet Explorer -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mengatur viewport agar responsif pada perangkat mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Menyertakan CSS dari Bootstrap untuk styling halaman -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menyertakan font Poppins dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Caesar Cipher Encryption</title>
    <style>
        /* Gaya untuk elemen body dengan latar belakang gradien dan font Poppins */
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        /* Gaya untuk container utama */
        .container {
            margin-top: 100px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            max-width: 700px;
        }
        /* Gaya untuk header kartu */
        .card-header {
            background-color: #4e54c8;
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 20px;
            font-size: 1.5rem;
        }
        /* Gaya untuk tombol dengan efek hover */
        .btn-primary, .btn-danger {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #4e54c8;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3a3f9f;
        }
        .btn-danger {
            background-color: #e94e77;
            border: none;
        }
        .btn-danger:hover {
            background-color: #d43f5e;
        }
        /* Gaya untuk elemen input fokus */
        .form-control:focus {
            box-shadow: none;
            border-color: #4e54c8;
        }
        /* Gaya untuk kotak hasil */
        .result-box {
            margin-top: 30px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .result-box td {
            padding: 12px 20px;
        }
        /* Gaya untuk footer */
        .footer {
            margin-top: 30px;
            color: #6c757d;
            font-size: 0.875rem;
        }
        /* Gaya untuk teks header */
        .header-text {
            font-size: 2rem;
            font-weight: 600;
            color: #ffffff;
        }
        .header-text small {
            display: block;
            font-size: 1rem;
            color: #e0e0e0;
        }
        /* Gaya untuk teks dalam grup input */
        .input-group-text {
            background-color: #f1f3f5;
            border: none;
            color: #4e54c8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <!-- Judul dan deskripsi untuk aplikasi Caesar Cipher -->
                <h4 class="header-text">Caesar Cipher Encryption <small>Encrypt or Decrypt Your Text</small></h4>
            </div>
            <div class="card-body">
                <!-- Formulir input untuk teks dan kunci enkripsi/dekripsi -->
                <form name="caesarCipher" method="post">
                    <div class="mb-4">
                        <label for="plainText" class="form-label">Input Text</label>
                        <input type="text" name="plain" class="form-control" id="plainText" placeholder="Enter text to encrypt or decrypt" required>
                    </div>
                    <div class="mb-4">
                        <label for="key" class="form-label">Input Key</label>
                        <input type="number" name="key" class="form-control" id="key" placeholder="Enter key for encryption/decryption" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <!-- Tombol untuk melakukan enkripsi atau dekripsi -->
                        <button type="submit" name="enkripsi" class="btn btn-primary" style="width: 48%">Encrypt</button>
                        <button type="submit" name="dekripsi" class="btn btn-danger" style="width: 48%">Decrypt</button>
                    </div>
                </form>
                <!-- Kotak hasil untuk menampilkan output enkripsi/dekripsi -->
                <div class="result-box mt-4">
                    <h5 class="mb-4">Results</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td><b>Output:</b></td>
                            <td>
                                <?php
                                // Definisi fungsi enkripsi
                                function enkripsi($input, $key)
                                {
                                    $output = "";
                                    $chars = str_split($input);
                                    foreach ($chars as $char) {
                                        $output .= cipher($char, $key);
                                    }
                                    return $output;
                                }
                                // Definisi fungsi dekripsi
                                function dekripsi($input, $key)
                                {
                                    return enkripsi($input, 26 - $key);
                                }
                                // Fungsi cipher untuk enkripsi dan dekripsi
                                function cipher($char, $key)
                                {
                                    if (ctype_alpha($char)) {
                                        $nilai = ord(ctype_upper($char) ? 'A' : 'a');
                                        $ch = ord($char);
                                        $mod = ($ch - $nilai + $key) % 26;
                                        $hasil = chr($mod + $nilai);
                                        return $hasil;
                                    } else {
                                        return $char;
                                    }
                                }
                                // Menampilkan hasil enkripsi atau dekripsi sesuai dengan tombol yang ditekan
                                if (isset($_POST['enkripsi'])) {
                                    echo htmlspecialchars(enkripsi($_POST['plain'], $_POST['key']));
                                }
                                if (isset($_POST['dekripsi'])) {
                                    echo htmlspecialchars(dekripsi($_POST['plain'], $_POST['key']));
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Input Text:</b></td>
                            <td>
                                <?php
                                if (isset($_POST['enkripsi']) || isset($_POST['dekripsi'])) {
                                    echo htmlspecialchars($_POST['plain']);
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Key:</b></td>
                            <td>
                                <?php{}
                                if (isset($_POST['enkripsi']) || isset($_POST['dekripsi'])) {
                                    echo htmlspecialchars($_POST['key']);
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- Footer halaman dengan copyright -->
        <div class="footer text-center mt-4">
            <p>&copy; 2024 Caesar Cipher Encryption by Yunita Kartika Putri</p>
        </div>
    </div>

    <!-- Menyertakan JavaScript dari Bootstrap untuk fitur interaktif -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
