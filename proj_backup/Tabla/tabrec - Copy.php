<html>
<?php

session_start();

$_SESSION['n']=time();
echo $_SESSION['n'];
?>



<font size="4">
<p>You can take a look at following instruments:</p>

<div>

    <p>1)Drums :  <button onclick="fun1()">Location</button><button onclick="fun2()">preview</button></p>
	<p>2)Chenda : <button onclick="fun3()">Location</button><button onclick="fun4()">preview</button></p>
	<p>3)Mrudang :<button onclick="fun5()">Location</button><button onclick="fun6()">preview</button></p>
	<p>4)Daf :    <button onclick="fun7()">Location</button><button onclick="fun8()">preview</button></p>
	<p>5)Conga  : <button onclick="fun9()">Location</button><button onclick="fun10()">preview</button></p>
	<p>6)Pakhawaj:<button onclick="fun11()">Location</button><button onclick="fun12()">preview</button></p>

</font>
<script>

function fun1()
{
window.open("http://192.168.0.102/project/tabla/tabloc1.html");
}
function fun2()
{
window.open("http://192.168.0.102/project/tabla/drums.jpg");
}function fun3()
{
window.open("http://192.168.0.102/project/tabla/tabloc2.html");
}function fun4()
{
window.open("http://192.168.0.102/project/tabla/chenda.jpg");
}
function fun5()
{
window.open("http://192.168.0.102/project/tabla/tabloc3.html");
}
function fun6()
{
window.open("http://192.168.0.102/project/tabla/mridang.jpg");
}
function fun7()
{
window.open("http://192.168.0.102/project/tabla/tabloc1.html");
}
function fun8()
{
window.open("http://192.168.0.102/project/tabla/daf.jpg");
}
function fun9()
{
window.open("http://192.168.0.102/project/tabla/tabloc2.html");
}
function fun10()
{
window.open("http://192.168.0.102/project/tabla/conga.jpg");
}
function fun11()
{
window.open("http://192.168.0.102/project/tabla/tabloc3.html");
}
function fun12()
{
window.open("http://192.168.0.102/project/tabla/pakhawaj.jpg");
}
</script>
<a href="http://192.168.0.102/project/tabla/tabloc1.html" target="_self"></a>
<a href="http://192.168.0.102/project/tabla/tabloc2.html" target="_self"></a>
<a href="http://192.168.0.102/project/tabla/tabloc3.html" target="_self"></a>

<?php
unset($_SESSION['ses']);
$stop=time();
$sest=ses-$stop;
?>
</html>

