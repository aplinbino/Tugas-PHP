<?php
$matkul = [
    ["nama" => "Algoritma dan Pemrograman", "sks" => 3, "nilai" => 90],
    ["nama" => "Basis Data", "sks" => 3, "nilai" => 80],
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 75],
    ["nama" => "Matematika Diskrit", "sks" => 2, "nilai" => 60],
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 45]
];

function hitungBobot($nilai) {
    if ($nilai >= 85) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 75) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 65) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

$totalSKS = 0;
$totalMutu = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Nilai Mata Kuliah</title>
</head>
<body>

    <h1>Daftar Nilai Mata Kuliah</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Bobot</th>
            <th>Status</th>
        </tr>

        <?php
        $no = 1;

        foreach ($matkul as $m) {

            $hasil = hitungBobot($m["nilai"]);

            $huruf = $hasil["huruf"];
            $bobot = $hasil["bobot"];

            $status = ($bobot >= 2.0) ? "LULUS" : "MENGULANG";

            $mutu = $bobot * $m["sks"];

            $totalSKS += $m["sks"];
            $totalMutu += $mutu;

            $warna = ($status == "MENGULANG")
                ? 'style="background-color: red; color: white;"'
                : '';
        ?>

        <tr <?= $warna ?>>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($m["nama"]) ?></td>
            <td><?= $m["sks"] ?></td>
            <td><?= $m["nilai"] ?></td>
            <td><?= $huruf ?></td>
            <td><?= number_format($bobot, 1) ?></td>
            <td><?= $status ?></td>
        </tr>

        <?php } ?>
    </table>

    <?php
    $ips = ($totalSKS > 0) ? $totalMutu / $totalSKS : 0;

    $maksSKS = ($ips >= 3.00) ? 24 : 20;
    ?>

    <h2>Ringkasan IPS</h2>

    <p>Total SKS: <?= $totalSKS ?></p>
    <p>Total Mutu: <?= number_format($totalMutu, 2) ?></p>
    <p>IPS: <?= number_format($ips, 2) ?></p>

    <h3>Batas SKS Semester Depan</h3>
    <p>Maksimal pengambilan: <?= $maksSKS ?> SKS</p>

</body>
</html>
