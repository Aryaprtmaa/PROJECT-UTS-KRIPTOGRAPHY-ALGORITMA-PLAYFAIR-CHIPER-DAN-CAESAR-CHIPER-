<?php
session_start();
$result = $_SESSION['result'] ?? '';
$log = $_SESSION['processLog'] ?? null;
?>
<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <title>Playfair + Caesar Cipher Demo</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='assets/css/style.css' rel='stylesheet'>
</head>
<body class='bg-dark text-light'>
<div class='container py-5'>
    <h2 class='text-center mb-4 text-info'>🔐 Playfair + Caesar Cipher</h2>

    <form action='action.php' method='POST' class='card bg-secondary p-3 shadow'>
        <div class='row g-2'>
            <div class='col-md-6'>
                <label class='form-label'>Teks</label>
                <textarea class='form-control' name='text' rows='3' required><?= htmlspecialchars($_SESSION['text'] ?? '') ?></textarea>
            </div>
            <div class='col-md-6'>
                <label class='form-label'>Kunci Playfair</label>
                <input type='text' class='form-control' name='key' value='<?= htmlspecialchars($_SESSION['key'] ?? '') ?>' required>
                <div class='mt-3'>
                    <label class='form-label'>Shift Caesar</label>
                    <input type='number' name='shift' class='form-control' value='<?= htmlspecialchars($_SESSION['shift'] ?? 3) ?>' min='0' max='25'>
                </div>
            </div>
        </div>
        <div class='mt-3 text-center'>
            <button name='action' value='encrypt' class='btn btn-info'>🔒 Enkripsi</button>
            <button name='action' value='decrypt' class='btn btn-warning'>🔓 Dekripsi</button>
            <a href='clear.php' class='btn btn-danger'>🧹 Reset</a>
        </div>
    </form>

    <?php if ($result): ?>
    <div class='card mt-4 border-info shadow'>
        <div class='card-header bg-info text-dark d-flex justify-content-between'>
            <span>Hasil Akhir (<?= strtoupper($_SESSION['mode']) ?>)</span>
            <button class='btn btn-sm btn-dark text-info' onclick='copyResult()'>Copy</button>
        </div>
        <div class='card-body'>
            <textarea id='resultBox' class='form-control text-center' rows='2' readonly><?= htmlspecialchars($result) ?></textarea>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($log): ?>
    <div class='card mt-4 border-success shadow'>
        <div class='card-header bg-dark text-success'>
            📜 Log Proses Algoritma
        </div>
        <div class='card-body bg-dark text-light'>

            <!-- Log Playfair -->
            <?php if (!empty($log['playfair'])): ?>
                <h5 class='text-info mt-3'>🔹 Log Playfair Cipher</h5>
                <?php if (isset($log['playfair']['matrix'])): ?>
                <table class='table table-bordered table-dark text-center mb-3'>
                    <?php foreach ($log['playfair']['matrix'] as $row): ?>
                        <tr>
                            <?php foreach ($row as $c): ?>
                                <td><?= htmlspecialchars($c) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>

                <?php if (isset($log['playfair']['steps'])): ?>
                <div class='mb-3'>
                    <ul class='list-group'>
                    <?php foreach ($log['playfair']['steps'] as $step): ?>
                        <li class='list-group-item bg-secondary text-light'>
                            <strong><?= htmlspecialchars($step['pair']) ?></strong> → <?= htmlspecialchars($step['result']) ?> 
                            <small class='text-info'>(<?= htmlspecialchars($step['rule']) ?>)</small>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Log Caesar -->
            <?php if (!empty($log['caesar'])): ?>
                <h5 class='text-warning mt-4'>🔹 Log Caesar Cipher</h5>
                <p><strong>Shift:</strong> <?= htmlspecialchars($log['caesar']['shift']) ?></p>
                <p><strong>Input dari Playfair:</strong> <?= htmlspecialchars($log['caesar']['input'] ?? '-') ?></p>
                <p><strong>Hasil Caesar:</strong> <?= htmlspecialchars($log['caesar']['result'] ?? '-') ?></p>
                <p><em><?= htmlspecialchars($log['caesar']['note'] ?? '') ?></em></p>
            <?php endif; ?>

        </div>
    </div>
    <?php endif; ?>

</div>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>
<script>
function copyResult() {
    const box = document.getElementById('resultBox');
    box.select();
    document.execCommand('copy');
    alert('Hasil disalin ke clipboard!');
}
</script>
</body>
</html>
