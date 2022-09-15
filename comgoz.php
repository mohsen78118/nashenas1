<?php
function request ($field) {
    return isset($_REQUEST[$field]) && $_REQUEST[$field]!=""?$_REQUEST[$field]:null;
}

$errors=[];
$successe=false;

function has_errorr ($field) {
    global $errors;
    return isset($errors['filed']);
}

function get_errorr ($field) {
    global $errors;
    return has_errorr($field)?$errors['filed']:null;
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $comment=request('comment');
}

if (is_null($comment)) {
    echo $errors['comment']='please take a text';
}
if (!is_null($comment)) {
    $link = mysqli_connect('localhost:3306', 'root', '');
    if (!$link){
        echo 'error'.mysqli_error();
        exit();
    }

    mysqli_select_db($link,'comgoz');
//$sql='create database comgoz';
//    $sql='create table comgoz(id int AUTO_INCREMENT, comment varchar(250)not null ,primary key (id))';
    $sql="insert into comgoz(comment)values ('$comment')";
    $result=mysqli_query($link,$sql);
    if ($result){
        $successe=true;
    }else{
        echo 'error'.mysqli_connect_error($link);
        exit();
    }
}
$link = mysqli_connect('localhost:3306', 'root', '');
mysqli_select_db($link,'comgoz');
$sql3="select * from comgoz order by id desc ";
$result1=mysqli_query($link,$sql3);

?>
<html>
<head>
    <title>send register</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="border">
<h3>Leave anonymous</h3>
<?php if ($successe) {?>
   <span id="suc"><?= 'sended your anoymous' ?></span>
<?php } ?>
<form action="#" method="post">

    <input type="text" name="comment" placeholder="take a text"> <br><br>
      <?php if (has_errorr('comment')) { ?>
        <span id="error1"><?php get_errorr('comment') ?> </span>
     <?php } ?>

    <button type="submit">send</button>
</form>
<!--goz-->
<div class="table">
<table>
    <thead>
    <tr>
        <th id="number">number</th>
        <th id="comment">comment</th>
    </tr>

    </thead>
    <tbody>
       <?php while ($user=mysqli_fetch_assoc($result1)) {?>
        <tr>
            <td id="id"><?=$user['id'] ?></td>
            <td id="comm"><?=$user['comment'] ?></td>


        </tr>
<?php } ?>
    </tbody>
</table>
</div>
</div>
</body>
</html>
