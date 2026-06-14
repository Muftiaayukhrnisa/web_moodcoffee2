<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QRIS Payment - MoodCoffee</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #fcf8f0;
            font-family: system-ui, -apple-system, 'Inter', sans-serif;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            overflow: hidden;
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 1200px;
            height: 90%;
            background: white;
            border-radius: 48px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid #f0e2d4;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .header {
            background: #5a3e2b;
            padding: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: white;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: row; /* Landscape: 2 kolom */
            justify-content: center;
            align-items: center;
            gap: 40px;
            padding: 40px;
            overflow-y: auto;
        }

        /* Kolom kiri: Timer */
        .left {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .timer-box {
            text-align: center;
        }

        .timer-label {
            font-size: 1.2rem;
            font-weight: 500;
            color: #a1826b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .timer {
            font-family: monospace;
            font-size: 4rem;
            font-weight: 800;
            color: #b45f2b;
            margin-top: 10px;
        }

        /* Kolom kanan: QR + tombol */
        .right {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 30px;
        }

        .qris-box {
            text-align: center;
        }

        .qris-title {
            font-size: 1rem;
            font-weight: 600;
            color: #b45f2b;
            letter-spacing: 2px;
            margin-bottom: 16px;
        }

        .qris-code {
            background: white;
            padding: 20px;
            border: 2px dashed #d9c6b2;
            border-radius: 32px;
            display: inline-block;
        }

        .qris-code img {
            width: 220px;
            height: 220px;
            object-fit: contain;
        }

        .btn {
            background: #5a3e2b;
            border: none;
            padding: 14px 32px;
            border-radius: 60px;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #3e2a1c;
        }

        .btn:disabled {
            background: #c7b8a8;
            cursor: not-allowed;
        }

        .footnote {
            font-size: 0.8rem;
            color: #bfaa99;
            margin-top: 20px;
        }

        /* Responsif: jika layar terlalu kecil, tata ulang vertikal */
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
                gap: 20px;
                padding: 20px;
            }
            .timer {
                font-size: 3rem;
            }
            .qris-code img {
                width: 180px;
                height: 180px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="header">
            <h1>QRIS Payment</h1>
        </div>
        <div class="content">
            <!-- Kolom kiri: Timer -->
            <div class="left">
                <div class="timer-box">
                    <div class="timer-label">Selesaikan Pembayaran Sebelum</div>
                    <div class="timer" id="countdown">05:00</div>
                </div>
            </div>

            <!-- Kolom kanan: QR Code + Tombol -->
            <div class="right">
                <div class="qris-box">
                    <div class="qris-title">SCAN QRIS</div>
                    <div class="qris-code">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"
                             alt="QRIS Code"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=QRIS+Code+Not+Available';">
                    </div>
                    <p class="footnote">Gunakan aplikasi pembayaran (QRIS) untuk scan</p>
                </div>

                <form action="{{ route('payment.success', $order) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn" id="checkStatusBtn">Cek Status Pembayaran</button>
                </form>
                <p class="footnote">*Setelah membayar, klik tombol di atas untuk konfirmasi</p>
            </div>
        </div>
    </div>
</div>

<script>
    let timeLeft = 300;
    const countdownEl = document.getElementById('countdown');
    const checkBtn = document.getElementById('checkStatusBtn');

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }

    function updateTimer() {
        countdownEl.textContent = formatTime(timeLeft);
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            countdownEl.textContent = "00:00";
            countdownEl.classList.add('text-red-600');
            if (checkBtn) {
                checkBtn.disabled = true;
                checkBtn.textContent = "Waktu Habis";
                checkBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            }
            alert('Waktu pembayaran telah habis. Silakan lakukan pemesanan ulang.');
        }
        timeLeft--;
    }

    let timerInterval = setInterval(updateTimer, 1000);
    updateTimer();
</script>
</body>
</html>