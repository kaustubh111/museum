<?php
session_start();
$_SESSION['dt1']='drums';
$_SESSION['dt2']=time();
if (isset($_GET['action'])) {
   $_SESSION['dt3'] = $_GET['action'];
   $mac=fopen("C:\wamp\www\Project\Apriori\mac.txt","a");
   
   
   fwrite($mac,$_SESSION['dt3'].PHP_EOL);
  
}
$host='localhost';
$servername="mysql wampserver";
$username="root";
$passwrd="kaustubh143";
$db="data";

$conn = mysqli_connect($host, $username, $passwrd,$db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$t=time();

$sqliu="Create table `{$_SESSION['dt3']}` (name varchar(10) NOT NULL,obj int(10) NOT NULL)";
mysqli_query($conn,$sqliu);
	
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
            }



$sql1="INSERT into `{$_SESSION['dt3']}` values('{$_SESSION['dt1']}','$t')";
mysqli_query($conn,$sql1);




?>

<html>
   <body>
    <h2>Drums</h2>
<marquee scrolldelay="10">
        <img src="http://192.168.43.194/Project/Images/drums.jpg" width="35%" height="40%" alt="Image is Loading..."/>
</marquee>
<p>A drum kit, drum set, trap set, or just drums is a collection of drums and other percussion 
instruments, typically cymbals, which are set up on stands to be played by a single player with
drumsticks held in both hands and the feet operating pedals that control the hi-hat cymbal and 
the beater for the bass drum. A drum kit consists of a mix of drums and idiophones most significantly
cymbals but also including the woodblock and cowbell. In the 2000s, some kits also include electronic
 instruments (Hornbostel-Sachs classification 53) and both hybrid and entirely electronic kits are used.</p>
<p>Many drummers extend their kits from this basic pattern, adding more drums, more cymbals, and many 
other instruments including pitched percussion. In some styles of music particular extensions are normal,
for example double bass drums in heavy metal music and the enlarged kits used by some progressive rock 
drummers, which may include unusual instruments such as gongs.</p>
<a href="http://192.168.43.194/Project/drums/drumsmore.html">read more</a>
<br>
<br>
      
<a href="http://192.168.43.194/Project/Music/drums.mp3" />
   
    <input type="submit" value="Listen Audio" name="Audio Button" />

<a href="http://192.168.43.194/Project/Video/drums.MKV"/>
          
    <input type="submit" value="Watch Video" name="Video Button" />
        
    
    </body>
</html>