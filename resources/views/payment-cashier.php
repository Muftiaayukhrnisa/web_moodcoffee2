<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment - MoodCoffee</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: #fcf8f0;
            font-family: system-ui, -apple-system, 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            padding: 0;
            margin: 0;
        }
        .card {
            width: 100vw;
            height: 100vh;
            background: white;
            border-radius: 0;
            box-shadow: none;
            overflow: hidden;
            border: none;
            display: flex;
            flex-direction: column;
        }
        .header {
            background: #5a3e2b;
            padding: 16px 24px;
            text-align: center;
            flex-shrink: 0;
        }
        .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin: 0;
        }
        .content {
            flex: 1;
            padding: 32px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .landscape-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: center;
            height: 100%;
        }
        .left-col {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }
        .right-col {
            display: flex;
            flex-direction: column;
            gap: 32px;
            align-items: center;
        }
        .timer-box {
            text-align: center;
            background: #fef6e8;
            border-radius: 32px;
            padding: 24px;
        }
        .timer-label {
            font-size: 16px;
            font-weight: 500;
            color: #a1826b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .timer {
            font-family: monospace;
            font-size: 56px;
            font-weight: 800;
            color: #b45f2b;
            margin-top: 8px;
        }
        .brand-box {
            text-align: center;
            border-top: 1px solid #f0e2d4;
            border-bottom: 1px solid #f0e2d4;
            padding: 20px 0;
        }
        .brand {
            font-size: 32px;
            font-weight: 800;
            color: #2c2a24;
        }
        .nmdid {
            font-size: 12px;
            color: #9b7c64;
            margin-top: 4px;
        }
        .barcode-wrap {
            text-align: center;
        }
        .barcode-title {
            font-size: 14px;
            font-weight: 600;
            color: #b45f2b;
            letter-spacing: 2px;
            margin-bottom: 16px;
        }
        .static-barcode {
            background: white;
            padding: 16px;
            border: 2px dashed #d9c6b2;
            border-radius: 24px;
            display: inline-block;
        }
        .static-barcode img {
            width: 100%;
            max-width: 280px;
            height: auto;
        }
        .order-number {
            font-family: monospace;
            font-weight: bold;
            font-size: 18px;
            margin-top: 12px;
            color: #2c2a24;
        }
        .footnote {
            text-align: center;
            font-size: 12px;
            color: #bfaa99;
            margin-top: 24px;
            grid-column: span 2;
        }
        @media (max-width: 800px) {
            .content {
                padding: 24px;
            }
            .landscape-grid {
                gap: 24px;
            }
            .timer {
                font-size: 40px;
            }
            .brand {
                font-size: 24px;
            }
        }
        @media (max-width: 600px) {
            .landscape-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            .footnote {
                grid-column: span 1;
            }
            .static-barcode img {
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
<div class="card">
    <div class="header">
        <h1>Payment</h1>
    </div>
    <div class="content">
        <div class="landscape-grid">
            <!-- Kolom Kiri -->
            <div class="left-col">
                <div class="timer-box">
                    <div class="timer-label">Selesaikan Waktu Pembayaran</div>
                    <div class="timer" id="countdown">05:00</div>
                </div>
                <div class="brand-box">
                    <div class="brand">MOODCOFFEE</div>
                    <div class="nmdid"></div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="right-col">
                <div class="barcode-wrap">
                    <div class="barcode-title">BARCODE UNTUK BAYAR DI KASIR</div>
                    <div class="static-barcode">
                        <img src="https://img.magnific.com/vektor-premium/garis-garis-vertikal-hitam-putih-kode-batang-untuk-identifikasi-produk_1184967-32973.jpg?semt=ais_hybrid&w=740&q=80" 
                             alt="Barcode Pembayaran"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x200?text=Barcode+Not+Available';">
                    </div>
                    <div class="order-number"></div>
                </div>
                <!-- Tombol Cek Status Pembayaran telah dihapus -->
            </div>
            <div class="footnote">*Pastikan pembayaran sudah dilakukan sebelum waktu habis</div>
        </div>
    </div>
</div>

<script>
    let timeLeft = 300;
    const timerDisplay = document.getElementById('countdown');

    function formatTime(seconds) {
        let mins = Math.floor(seconds / 60);
        let secs = seconds % 60;
        return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }

    function updateTimer() {
        timerDisplay.textContent = formatTime(timeLeft);
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            timerDisplay.textContent = "00:00";
            alert('Waktu pembayaran telah habis. Silakan lakukan pemesanan ulang.');
        }
        timeLeft--;
    }

    let timerInterval = setInterval(updateTimer, 1000);
    updateTimer();
</script>
</body>
</html>