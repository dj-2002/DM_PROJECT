

<?php


if(isset($_POST['submit']))
{   
    // ob_start();
    require('fpdf.php');
    $total = count($_FILES['image']['name']);
    $pdf = new FPDF();
    // $pdf->AddPage();
    $i=0;
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
      $maxWidth = $pdf->GetPageWidth()-20;
      if($width > $maxWidth){
        $width = $maxWidth;
      }
      $height = $width/$ratio;

      // $x = ($pdf->GetPageWidth()-$width)/2;

      // // $pdf->AddPage();
      // $pdf->Image($image,$x,null,$width);
      // // $pdf->Image($image);

      $x = ($pdf->GetPageWidth()-$width)/2;
      $y = ($pdf->GetPageHeight()-$height)/2;
      // echo $y+" ";
      // echo $height;
      // echo $pdf->GetPageHeight();
      // echo 
      $pdf->AddPage();
      // echo $i;
      try {
        $pdf->Image($image,$x,$y,$width,null);
      }
      catch (Exception $e) {
        // echo "Something went wrong";
        // echo "in Exception";
        // echo(($e));
          if($e->getMessage()){
            echo "<div>".($e->getMessage())."</div>";
            // echo "<script>document.getElementById('error-box').innerHTML = '".$e->getMessage()."';</script>";
          }else{
            echo "<script>alert('Something went wrong')</script>";
          }
          // echo "<script>alert('".$e->Error()."')</script>";
          // echo "Something went wrong";
          break;
      }
      
      unlink($image);
    }
    if($i == $total){
      $pdf->Output('I','file.pdf');
    }

    // ob_end_flush();
    

    
}
?>


<?php include '../header.php' ?>





<style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Exo+2:400,700,500,300);

body {
  background:white;
  font-family: "Exo 2";
}

.zone {      
  margin: 30px auto;
  position: relative;
  top: 0; left: 0; bottom: 0; right: 0;
  background: radial-gradient(ellipse at center,#EB6A5A 0,#c9402f 100%);
  width:60%;
  height:35%;  
  border:5px dashed white;
  text-align:center;
  color: white;
  z-index: 20;
  transition: all 0.3s ease-out;
  display: flex;
    flex-direction: column;
    padding: 30px 40px;
    /*background: rgb(255 159 25);*/
    flex-direction: column;
    justify-content: center;

}
  box-shadow: 0 0 0 1px rgba(255,255,255,.05),inset 0 0 .25em 0 rgba(0,0,0,.25);
  .btnCompression {
    .btn {

    } 
    .active {
      background: #EB6A5A;
      color:white;
    }
  }
  i {
    text-align: center;
    font-size: 10rem;  
    color:#fff;
    /margin-top: 50px;/
  }
  .selectFile {
    height: 50px;
    margin: 20px auto;
    position: relative;
    width: 200px;          
  }

  label, input {
    cursor: pointer;
    display: block;
    height: 50px;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    border-radius: 5px;          
  }

  label {
    background: #fff;
    color:#EB6A5A;
    display: inline-block;
    font-size: 1.2em;
    line-height: 50px;
    padding: 0;
    text-align: center;
    white-space: nowrap;
    text-transform: uppercase;
    font-weight: 400;   
    box-shadow: 0 1px 1px gray;
  }

  input[type=file] {
    opacity: 0;
  }
  input[type=submit] {
    opacity: 0;
  }

}
.zone.in {
  color:white;
  border-color:white;
  background: radial-gradient(ellipse at center,#EB6A5A 0,#c9402f 100%);
  i {          
    color:#fff;
  }
  label {
    background: #fff;
    color:#EB6A5A;
  }
}
.zone.hover {
  color:gray;
  border-color:white;
  background:#fff;
  border:5px dashed gray;
  i {          
    color:#EB6A5A;
  }
  label {
    background: #fff;
    color:#EB6A5A;
  }
}
.zone.fade {
  transition: all 0.3s ease-out;
  opacity: 1;
}

#remove:hover{
    color:black;
    font-size: xx-large;
    cursor: pointer;
}
.fa-trash:before {
    content: "\f1f8";
    font-size: xx-large;
}

</style>


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
<script type="text/javascript">
    
$(document).ready(function(){    

$('.selectBlock').show();
$('.submitBlock').hide();
$("#fileInput").change(function() {
    $('.selectBlock').hide();
    $('.submitBlock').show();
    var inp = document.getElementById('fileInput');
    var str=[];
    for (var i=0;i<inp.files.length;i++)
    {
        str[i]=inp.files.item(i).name;
        str[i]+="  "
    }
    document.getElementById("finfo").innerHTML=str;
});
});
$("#remove").click(function(){
    location.reload();
})

</script>
