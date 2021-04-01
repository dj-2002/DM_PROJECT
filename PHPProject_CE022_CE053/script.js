
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
