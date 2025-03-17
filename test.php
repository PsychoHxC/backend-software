<?php
$file = 'uploads/test.txt';
$content = "Prueba de permisos de escritura.";

if (file_put_contents($file, $content)) {
    echo "✅ Permisos correctos: El archivo se guardó en uploads.";
} else {
    echo "❌ Error: No se pudo escribir en uploads.";
}
?>