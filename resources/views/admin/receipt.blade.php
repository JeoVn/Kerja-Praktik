<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembelian</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h3, h4 { text-align: center; margin: 0; }
        hr { border-top: 1px dashed #000; }
        .receipt { max-width: 500px; margin: auto; }
        .item { margin-bottom: 10px; }
        .total { font-weight: bold; margin-top: 10px; }
        .text-center { text-align: center; }
        @media print {
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h3>Apotek Anugrah</h3>
        <h4>Struk Pembelian</h4>
        <hr>

        @foreach($receipt['items'] as $item)
            <div class="item">
                <p><strong>Nama Obat:</strong> {{ $item['nama_obat'] }}</p>
                <p><strong>Kode Obat:</strong> {{ $item['kode_obat'] }}</p>
                <p><strong>Jumlah:</strong> {{ $item['jumlah'] }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($item['total'], 0, ',', '.') }}</p>
                <hr>
            </div>
        @endforeach

        <p class="total"><strong>Total Setelah Diskon:</strong> Rp {{ number_format($receipt['totalHarga'], 0, ',', '.') }}</p>

        @if($receipt['diskon'] > 0)
            <p><strong>Diskon:</strong> {{ $receipt['diskon'] }}%</p>
        @endif

        <div class="text-center print-btn">
            <button onclick="window.print()">Cetak</button>
        </div>
    </div>
</body>
</html>
