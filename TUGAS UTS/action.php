<?php
session_start();
include 'playfair.php';

// Ambil input
$text   = $_POST['text'] ?? '';
$key    = $_POST['key'] ?? '';
$shift  = intval($_POST['shift'] ?? 3);
$action = $_POST['action'] ?? '';
$responseType = $_POST['responseType'] ?? 'html';

$log = [
    'playfair' => [],
    'caesar' => []
];

$result = '';

if ($action === 'encrypt') {
    // === Langkah 1: Playfair ===
    $playfairLog = [];
    $playfairResult = playfairEncrypt($text, $key, $playfairLog);

    // Simpan log Playfair
    $log['playfair'] = $playfairLog;

    // === Langkah 2: Caesar ===
    $caesarResult = caesarEncrypt($playfairResult, $shift);
    $log['caesar'] = [
        'shift' => $shift,
        'input' => $playfairResult,
        'result' => $caesarResult,
        'note' => 'Hasil Playfair dienkripsi lagi menggunakan Caesar Cipher.'
    ];

    $result = $caesarResult;

} elseif ($action === 'decrypt') {
    // === Langkah 1: Caesar ===
    $caesarDecrypted = caesarDecrypt($text, $shift);
    $log['caesar'] = [
        'shift' => $shift,
        'input' => $text,
        'result' => $caesarDecrypted,
        'note' => 'Teks didekripsi Caesar terlebih dahulu sebelum Playfair.'
    ];

    // === Langkah 2: Playfair ===
    $playfairLog = [];
    $result = playfairDecrypt($caesarDecrypted, $key, $playfairLog);
    $log['playfair'] = $playfairLog;

} else {
    $result = 'Invalid action';
}

// Simpan session untuk mode HTML
$_SESSION['text']        = $text;
$_SESSION['key']         = $key;
$_SESSION['shift']       = $shift;
$_SESSION['mode']        = $action;
$_SESSION['result']      = $result;
$_SESSION['processLog']  = $log;

// Jika request datang dari API → kirim JSON
if ($responseType === 'json' || isset($_GET['api'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'mode' => $action,
        'input' => $text,
        'key' => $key,
        'shift' => $shift,
        'result' => $result,
        'log' => $log
    ], JSON_PRETTY_PRINT);
    exit;
}

// Default redirect ke halaman utama
header('Location: index.php');
exit;
?>
