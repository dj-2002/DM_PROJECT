<?php
//Require composer autoloder.
require __DIR__.'/vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

// Set PDF renderer.
// Make sure you have `tecnickcom/tcpdf` in your composer dependencies.
Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
// Path to directory with tcpdf.php file.
// Rigth now `TCPDF` writer is depreacted. Consider to use `DomPDF` or `MPDF` instead.
Settings::setPdfRendererPath('vendor/tecnickcom/tcpdf');

$phpWord = IOFactory::load('C:\Windows\System32\WindowsPowerShell\v1.0\powershell.exe\document1.docx', 'Word2007');
$phpWord->save('document.pdf', 'PDF');
?>