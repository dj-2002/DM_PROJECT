
<?php

if(isset($_POST['submit']))
{   
    require_once 'vendor/autoload.php';
    
    $total = count($_FILES['image']['name']);
    
    $i=0;
    
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    

    $section = $phpWord->addSection();
    for( $i=0 ; $i < $total ; $i++ ) 
    {

      $image = $_FILES['image']['name'][$i];


      $target_dir = "";
      $target_file = $target_dir . basename($_FILES["image"]["name"][$i]);
      $uploadOk = 1;
     

      if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)) {
          //echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
      } 
      else {
          echo "Sorry, there was an error uploading your file.";
          break;
      }


      $image = dirname(__FILE__).DIRECTORY_SEPARATOR.$_FILES["image"]["name"][$i];
      
      list($width, $height, $type, $attr) = getimagesize($image);
      if($height != 0){
        $ratio = $width/$height;
      }else{
        echo "Division by zero Exception";
        break;
      }
      
      if($width > 400){
        $width = 400;
      }
      $height = $width/$ratio;
      

      $section->addImage(
          $image,
          array(
              'width'         => $width,
              'marginTop'     => 20,
              'marginLeft'    => 20, 
              'alignment'     => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
              'wrappingStyle' => 'behind'
          )
      );

 
    }
    if($i == $total){
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('file.docx');
        

        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        // $objWriter->save('file.html');
        $url = "file.docx";
        // header('Content-Description: File Transfer');
        // header('Content-Type: application/vnd.ms-word');
        // header('Content-Disposition: attachment; filename="'.basename($url).'"');
        // header('Content-Transfer-Encoding: binary');
        // header('Expires: 0');
        // header('Content-Length: ' . filesize($url));
        // header('Pragma: no-cache');

        //Clear system output buffer
        // flush();

        // //Read the size of the file
        // readfile($url);

        //Terminate from the script
        // die();

        //Define header information
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=$url");
        header("Content-Transfer-Encoding: binary ");

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile($url);



        unlink($url);
        // unlink('file.html');


    }

    // ob_end_flush();
    for( $i=0 ; $i < $total ; $i++ ) 
    {
      $image = dirname(__FILE__).DIRECTORY_SEPARATOR.$_FILES["image"]["name"][$i];
      unlink($image);
    }
        
}

?>
<?php include '../header.php' ?>

<h1> JPG/PNG to DOCX Converter </h1>
  
 <div>
    <form method="post" enctype="multipart/form-data">
     
     <div id="dropContainer">
      <div class="zone selectBlock">
        <div id="dropZ">
          <i class="fa fa-image" style="font-size:100px"></i>
          <div class="selectFile">       
            <label for="fileInput">Select file</label>                   
            <input type="file" name="image[]" id="fileInput" multiple>
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

<style type="text/css">
  h1{
    text-align: center;
    color: #3592e2;
    margin: 20px auto;
  }

  .zone{
    background: radial-gradient(ellipse at center,#41e42f 0,#66d24b 100%);
  }
</style>
