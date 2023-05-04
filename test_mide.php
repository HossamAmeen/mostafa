solution البرمجة العنكبوية 12_00-2_00 31_5_2022 ا.د_نجوى محمد عمر
////////////// 28
<?php 
function fun(&$array, &$any, $var1, $var2=3){
    if ($var2>$var1)
    {
        $a=$array;
        return;
    }
    foreach($array as $k => &$v)
    {
        $any[$k] = $k.$v;
    }
}
$array = array('a','b','c'=>"y");
fun($array, $a, 4);
print_r($a);
?>
///////////////////// 29
/^5[1-5][0-9]{14}$/

////////////////////// 31
<form action="", method="post">
    <input name="element[]">
    <input name="element[]">
    <input type="submit">
</form>

<?php
    if(isset($_POST['element'])){
        echo $_POST['element'][0].$_POST['element'][1];
    }
    ?>



//////////////////// 34
<?php
session_start();
$_SESSION['count'] = $_SESSION['count']+1;
echo $_SESSION['count'];
?>


    /////////////// 35
    
<html>
    <head>
        choose your version
    </head>
    <body>
        <?php
            setcookie("seen_intro",1);
        ?>
        <a href="/basic.php">basic</a>
            or
        <a href="/advance.php">advanced</a>
    </body>
</html>










البرمجة العنكبوتية 10_30-11_30 15_4_2022 د_نجوى عمر (Preview) Microsoft Forms


//////////////////// 10
<?php 
function fun(&$array, &$any, $var1, $var2=3){
    if ($var2>$var1)
    {
        $any=$array;
        return;
    }
    if(!is_array($any)) $any = array();
    foreach($array as $k => &$v)
    {
        if(is_array($v))
        {
            fun($v, $any[$k], $var1, ++$var2);
        }
        else
        $any[$k] = $v;
    }
}
$array = array("A"=>array('a','b','c'=>array('x')),'B'=>"y");
fun($array, $a, 1);
print_r($a);
?>









//////////////////// 14
<?php 
$a=0;
function &test(){
    global $a;
    $a=1;
    return $a;
}
$b = &test();
echo $b;
echo ";;;";
$a=2;
echo $b;

?>




البرمجة العنكبوتية 9_11 الاثنين 7_6_2021 أ.د.نجوى محمد عمر (Preview) Microsoft Forms

