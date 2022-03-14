<?php
session_start();
//session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link rel="stylesheet" href="style.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        <?php include 'style.css'; ?>
    </style>



    <title>Document</title>
</head>

<body>
    <div class='maindiv' >
        <div class='headdiv' >
            <h1>MY BLOG</h1>
        </div>
        <div>
            <textarea type='textarea' id='txtarea' rows="4" cols="50" ></textarea> </t> <input type='button' id='btnpost' value='Post'>

        </div>
        <div id='postdip' >

        </div>
    </div>
    <script>
        var pArr;
        $(document).ready(function() {
           
            $('#btnpost').on('click', function() {
                
                var blogf = document.getElementById('txtarea').value;
                document.getElementById('txtarea').value = "";
                $.ajax({
                    url: "functions.php",
                    type: "POST",
                    datatype: "JSON",
                    data: {
                        blogf: blogf,
                        "action": "post"
                    }
                }).done(function(data) {
                     pArr =  JSON.parse(data);
                    displayblog(pArr);
                })
            })
        })

function displayblog(pArr){
    var html ="<ol>";
  for(let i=0; i<pArr.length; i++){
      html += "<li><textarea  rows='4' columns='4' class='disptxtarea' id='"+i+"' value=' '>"+pArr[i]+"</textarea></t><input type='button' id='"+i+"'  class='btnedit' value='Update' onclick='editpost("+i+")' ><br><input type='button' id='"+i+"'  class='btndelete' value='Delete' onclick='deletepost("+i+")' ><br><br></li>"
  }
  html += "</ol>";
  document.getElementById('postdip').innerHTML = html;
}
function editpost(eid){
    for(let i=0; i<pArr.length; i++){
        if(i==eid){
            var edblog = document.getElementById(i).value;
            var edid = eid;
        }
    }
    $.ajax({
        url :"functions.php",
        type : "POST",
        datatype : "JSON",
        data:{
            edblog : edblog,
            edid : edid,
            "action" :"edit"
        }

    }).done(function(data){
        
          pArr = JSON.parse(data);
            displayblog(pArr);
    })

}
function deletepost(did){
    $.ajax({
        url : "functions.php",
        type : "POST",
        datatype : "JSON",
        data :{
            did : did,
            "action" : "remove"
        }
    }).done(function(data){
       pArr = JSON.parse(data);
       displayblog(pArr);
    })
}

    </script>
</body>

</html>