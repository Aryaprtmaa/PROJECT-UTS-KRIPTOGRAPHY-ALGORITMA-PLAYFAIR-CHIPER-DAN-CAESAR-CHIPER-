<?php
function generateMatrix($key, &$log) {
    $key = strtoupper(str_replace('J', 'I', preg_replace('/[^A-Z]/', '', $key)));
    $key .= "ABCDEFGHIKLMNOPQRSTUVWXYZ";
    $matrix = [];
    $used = [];
    for ($i = 0; $i < strlen($key); $i++) {
        $char = $key[$i];
        if (!in_array($char, $used)) $used[] = $char;
    }
    $matrix = array_chunk($used, 5);
    $log['matrix'] = $matrix;
    $log['matrix_info'] = "Matrix dibuat berdasarkan key.";
    return $matrix;
}

function prepareText($text) {
    $text = strtoupper(str_replace('J', 'I', preg_replace('/[^A-Z]/', '', $text)));
    $pairs = [];
    for ($i = 0; $i < strlen($text); $i += 2) {
        $a = $text[$i];
        $b = ($i + 1 < strlen($text)) ? $text[$i + 1] : 'X';
        if ($a == $b) { 
            $pairs[] = $a . 'X'; 
            $i--; 
        } else {
            $pairs[] = $a . $b;
        }
    }
    return $pairs;
}

function findPosition($matrix, $char) {
    foreach ($matrix as $r => $row)
        foreach ($row as $c => $cell)
            if ($cell == $char) return [$r, $c];
    return [null, null];
}

function playfairEncrypt($text, $key, &$log) {
    $matrix = generateMatrix($key, $log);
    $pairs = prepareText($text);
    $cipher = ""; 
    $log['mode'] = "Encrypt";
    $log['pairs'] = $pairs; 
    $log['steps'] = [];

    foreach ($pairs as $pair) {
        list($a,$b) = str_split($pair);
        list($ra,$ca) = findPosition($matrix,$a);
        list($rb,$cb) = findPosition($matrix,$b);

        if ($ra==$rb){
            $na=$matrix[$ra][($ca+1)%5];
            $nb=$matrix[$rb][($cb+1)%5];
            $rule="Baris sama → geser kanan";
        } elseif($ca==$cb){
            $na=$matrix[($ra+1)%5][$ca];
            $nb=$matrix[($rb+1)%5][$cb];
            $rule="Kolom sama → geser bawah";
        } else {
            $na=$matrix[$ra][$cb];
            $nb=$matrix[$rb][$ca];
            $rule="Berbeda baris & kolom → tukar kolom";
        }

        $cipher .= $na.$nb;
        $log['steps'][] = ['pair'=>$pair,'rule'=>$rule,'result'=>$na.$nb,'progress'=>$cipher];
    } 
    return $cipher;
}

function playfairDecrypt($text, $key, &$log) {
    $matrix = generateMatrix($key, $log);
    $pairs = prepareText($text);
    $plain = ""; 
    $log['mode'] = "Decrypt";
    $log['pairs'] = $pairs; 
    $log['steps'] = [];

    foreach ($pairs as $pair) {
        list($a,$b)=str_split($pair);
        list($ra,$ca)=findPosition($matrix,$a);
        list($rb,$cb)=findPosition($matrix,$b);

        if ($ra==$rb){
            $na=$matrix[$ra][($ca+4)%5];
            $nb=$matrix[$rb][($cb+4)%5];
            $rule="Baris sama → geser kiri";
        } elseif($ca==$cb){
            $na=$matrix[($ra+4)%5][$ca];
            $nb=$matrix[($rb+4)%5][$cb];
            $rule="Kolom sama → geser atas";
        } else {
            $na=$matrix[$ra][$cb];
            $nb=$matrix[$rb][$ca];
            $rule="Berbeda baris & kolom → tukar kolom";
        }

        $plain .= $na.$nb;
        $log['steps'][] = ['pair'=>$pair,'rule'=>$rule,'result'=>$na.$nb,'progress'=>$plain];
    }

    // 🔧 Bersihkan huruf X tambahan dari hasil dekripsi
    $plain = preg_replace('/([A-Z])X\\1/', '$1$1', $plain); // hapus X di antara huruf kembar
    $plain = rtrim($plain, 'X'); // hapus X di akhir
    return $plain;
}

// 🔒 Algoritma Caesar Cipher
function caesarEncrypt($text, $shift) {
    $result = '';
    $shift = $shift % 26;
    $text = strtoupper($text);

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if ($char >= 'A' && $char <= 'Z') {
            $result .= chr(((ord($char) - 65 + $shift) % 26) + 65);
        } else {
            $result .= $char;
        }
    }
    return $result;
}

function caesarDecrypt($text, $shift) {
    return caesarEncrypt($text, 26 - ($shift % 26));
}
?>
