<?php
  require __DIR__.'/vendor/autoload.php';

  use PhpOffice\PhpWord\IOFactory;
  use PhpOffice\PhpWord\Settings;
  if(isset($_POST['submit'])){

     $target_dir = "";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $uploadOk = 1;


      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          //echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
      } 
      else {
          echo "Sorry, there was an error uploading your file.";
      }

    $file = dirname(__FILE__).DIRECTORY_SEPARATOR.$_FILES["image"]["name"];

    // Set PDF renderer.
    // Make sure you have `tecnickcom/tcpdf` in your composer dependencies.
    Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
    // Path to directory with tcpdf.php file.
    // Rigth now `TCPDF` writer is depreacted. Consider to use `DomPDF` or `MPDF` instead.
    Settings::setPdfRendererPath('vendor/tecnickcom/tcpdf');

    $phpWord = IOFactory::load($file, 'Word2007');
    $phpWord->save('document.pdf', 'PDF');

    unlink($file);
}
?>

<?php include '../header.php' ?>
 <h1>
   DOCX to PDF Converter
 </h1>

  
 <div>
    <form method="post" enctype="multipart/form-data">
     
     <div id="dropContainer">
      <div class="zone selectBlock">
        <div id="dropZ">
          <i class="fa fa-file-word-o" aria-hidden="true" style="font-size:100px"></i>
          <div class="selectFile">       
            <label for="fileInput">Select file</label>                   
            <input type="file" name="image" id="fileInput">
          </div>
          
        </div>
      </div>
     </div>

     <div class="zone submitBlock">
     <div id="dropZ" >
          <div class="selectFile">       
            <label for="submit">Convert</label>                   
            <input type="submit" name="submit" id="submit" >
          </div>
          <p id="finfo"></p>
          <a id="remove" value="remove" alt="remove image"><i class="fa fa-trash"></i></a>
      </div>
     </div>
    </form> 
 </div>

  
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="script.js"></script>

<style type="text/css">
  h1{
    text-align: center;
    margin: 20px auto;
    color: #000;
  }
</style>