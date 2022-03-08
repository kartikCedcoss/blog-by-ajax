<?php
session_start();
if(!isset($_SESSION['post'])){
    $_SESSION['post']=array();
}
?>
<?php
 
 if(isset($_POST))
{
    $blogf = $_POST['blogf'];
    $edblog = $_POST['edblog'];
    $edid = $_POST['edid'];
    $did = $_POST['did'];
    $action = $_POST['action'];


    switch($action){
   case "post" :
    {
    
        post($blogf);
    }
    break ;
    case "edit" :
        {
            
            edit($edid,$edblog);
        }
        break ;

        case "remove" :
            {
                
                remove($did);
            }
            break ;

    }
}
 function post($blogf){
     if(!isset($_SESSION['post'])){
         $_SESSION['post']=array();
    }  
   $inblog = $blogf;
   array_push($_SESSION['post'],$inblog);
  echo json_encode($_SESSION['post']);

 }
function edit($edid,$edblog){
    
    for($i = 0; $i<count($_SESSION['post']); $i++){
        if($i==$edid){
            
            array_splice($_SESSION['post'],$i ,1,$edblog);
           
           echo json_encode(($_SESSION['post']));
        }
    }
}
function remove($did){
    for($i=0; $i<count($_SESSION['post']);$i++){
        if($i==$did){
            array_splice($_SESSION['post'],$i,1);
            echo json_encode($_SESSION['post']);
        }
    }
}

?>