<?php
session_start();
	 $_SESSION['vt1']='violin';
	 $_SESSION['vt2']=time();
	if (isset($_GET['action'])) 
		{
		
		$_SESSION['vt3'] = $_GET['action'];
		$mac=fopen("C:\wamp\www\Project\Apriori\mac.txt","a");
		fwrite($mac,$_SESSION['vt3'].PHP_EOL);
  
		}
$host='localhost';
$servername="mysql wampserver";
$username="root";
$passwrd="kaustubh143";
$db="data";
$db1="recommdata";
$conn1=mysqli_connect($host, $username, $passwrd,$db1);

$conn = mysqli_connect($host, $username, $passwrd,$db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql3="select succes from apr where predec like '%violin%' and percnt>90 and LENGTH(succes) <10"  ;
$result=mysqli_query($conn1,$sql3);

for ($resultArray1 = array(); $row = mysqli_fetch_array($result); $resultArray1[] = $row);
$resultArray1= call_user_func_array('array_merge', $resultArray1);

$Array3=array();

$Array3=array_unique($resultArray1);
 



  
$t=time();
$sqliu="Create table `{$_SESSION['vt3']}` (name varchar(10) NOT NULL,obj int(10) NOT NULL)";
mysqli_query($conn,$sqliu);
	
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
            }



$sql1="INSERT into `{$_SESSION['vt3']}` values('{$_SESSION['vt1']}','$t')";
mysqli_query($conn,$sql1);




?>

<html>
   <body>
    <h2>violin</h2>
<marquee scrolldelay="10">
        <img src="http://192.168.43.194/Project/Images/violin.jpg" width="35%" height="40%" alt="Image is Loading..."/>
</marquee>
<p>The violin is a family of a musical instrument in the woodwind group. Unlike woodwind
 instruments with reeds, a violin is an aerophone or reedless wind instrument that produces
 its sound from the flow of air across an opening. According to the instrument classification
 of Hornbostel–Sachs, violins are categorized as edge-blown aerophones.</p>
<p>A musician who plays the violin can be referred to as a violin player, flautist, 
flutist or, less commonly, violinr or violinnist.</p>
<a href="http://192.168.43.194/Project/violin/violinmore.html">read more</a>
<br>
 
<style "text/css">
.button1 {
    background-color: gray;
    border-radius: 12px;
    color: white;
    padding: 15px 32px;
    text-align: lift;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
}
.button2 {
    background-color: gray;
	border-radius: 12px;
    color: white;
    padding: 15px 32px;
    text-align: lift;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>

<a href="http://192.168.43.194/Project/Music/violin.mp3" class="button1">Audio</a>

<a href="http://192.168.43.194/Project/Music/violin.MKV" class="button1">Video</a>
        

</body>
<br>
<?php
echo "You may also like:".PHP_EOL;
$m=implode(", ",$Array3);
echo $m;	

?>       
</html>