<?php 


class Apriori {
    private $delimiter   = ','; 
    private $minSup      = 10; 
    private $minConf     = 75; 
     
    private $rules       = array(); 
    private $table       = array(); 
    private $allthings   = array();
    private $allsups     = array(); 
    private $keys        = array(); 
    private $freqItmsts  = array();    
    private $phase       = 1;
    
    //maxPhase>=2
    private $maxPhase    = 20; 
    
    private $fiTime      = 0;
    private $arTime      = 0; 
    
    public function setDelimiter($char)
    {
       $this->delimiter = $char;
    }
	public function dbconn()
	{
$host = "localhost";
$username = "root";
$servername="mysql wampserver";
$password = "kaustubh143";
$db1="data";
$conn1=mysqli_connect($host, $username, $password,$db1);
if(!$conn1)
{
	die ("connection failure:".mysqli_connect_error());
}
return $conn1;
	}
public function inputfl()
	{
$lines = file('C:\wamp\www\Project\Apriori\mac.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$lines = array_unique($lines);

file_put_contents('C:\wamp\www\Project\Apriori\mac.txt', implode(PHP_EOL, $lines));
$lines=array();
$fp=fopen('C:\wamp\www\Project\Apriori\mac.txt', 'r');
while (!feof($fp))
{
    $line=fgets($fp);

    //process line however you like
    $line=trim($line);

    //add to array
    $lines[]=$line;
}
$host="localhost";
$username = "root";
$servername="mysql wampserver";
$password = "kaustubh143";
$db1="data";
$conn1=mysqli_connect($host, $username, $password,$db1);
if(!$conn1)
{
	die ("connection failure:".mysqli_connect_error());
}

 $lines= new RecursiveIteratorIterator(new RecursiveArrayIterator($lines));
 foreach($lines as $v) {
echo $v;
  $sq="select name from `$v`";
  $result=mysqli_query($conn1,$sq);
 $sql_query5="Insert into timespent values('$v1',)";
  if($result==FALSE)
  {
	  echo "failed";
  }
  
for ($resultArray = array(); $row = mysqli_fetch_array($result); $resultArray[] = $row);

$Array2=array();
$Array2= call_user_func_array('array_merge', $resultArray);

foreach($Array2 as $s)
  {
	  $files=fopen("C:\wamp\www\Project\Apriori\order.txt","r+");
	  fwrite($files,$s.", ");
  }
  
   fwrite($files,PHP_EOL);
}


fclose($fp);
 
}
    
    public function setMinSup($int)
    {
       $this->minSup = $int;
    }
    
    public function setMinConf($int)
    {
       $this->minConf = $int;
    }
    
    public function setMaxScan($int)
    {
       $this->maxPhase = $int;
    }
    
    public function getDelimiter()
    {
       return $this->delimiter;
    }
    
    public function getMinSup()
    {
       return $this->minSup;
    }
    
    public function getMinConf()
    {
       return $this->minConf;
    }
    
    public function getMaxScan()
    {
       return $this->maxPhase;
    }
   
    private function makeTable($db)
    { 
       $table   = array();
       $array   = array();
       $counter = 1;
      

	   if(!is_array($db))
          {
			  
             $db = file($db);
			
          }
       $num = count($db);
	

       for($i=0; $i<$num-1; $i++) 
          {
             $tmp  = explode($this->delimiter, $db[$i]);
			
             $num1 = count($tmp);
             $x    = array();
			 
             for($j=0; $j<$num1; $j++) 
                {
                   $x = trim($tmp[$j]);
                   if($x==='')
                      {
                         continue;
                      }
                      
                   if(!isset($this->keys['v->k'][$x]))
                      {
                         $this->keys['v->k'][$x]         = $counter;
                         $this->keys['k->v'][$counter]   = $x;
                         $counter++;
                      } 
               
                   if(!isset($array[$this->keys['v->k'][$x]]))
                      {
                         $array[$this->keys['v->k'][$x]] = 1; 
                         $this->allsups[$this->keys['v->k'][$x]] = 1;                        
                      }
                   else
                      {
                         $array[$this->keys['v->k'][$x]]++; 
                         $this->allsups[$this->keys['v->k'][$x]]++;
                      }
               
                   $table[$i][$this->keys['v->k'][$x]] = 1; 
                } 
          }
 
       $tmp = array();
       foreach($array as $item => $sup) 
          { 
             if($sup>=$this->minSup)
                {
                   
                   $tmp[] = array($item);
                }
          }
  
       $this->allthings[$this->phase] = $tmp;
       $this->table = $table;	   
    }

    
    private function scan($arr, $implodeArr = '')
    { 
       $cr = 0;
          
       if($implodeArr)
          { 
             if(isset($this->allsups[$implodeArr]))
                { 
                   return $this->allsups[$implodeArr];
                }
          }
       else
          {
             sort($arr);
             $implodeArr = implode($this->delimiter, $arr);
             if(isset($this->allsups[$implodeArr]))
                { 
                  return $this->allsups[$implodeArr];
                }
          } 
       
       $num  = count($this->table);
       $num1 = count($arr); 
       for($i=0; $i<$num; $i++)
          {
             $bool = true; 
             for($j=0; $j<$num1; $j++)
                {
                   if(!isset($this->table[$i][$arr[$j]]))
                      {
                         $bool = false;
                         break;
                      }
                }
         
             if($bool)
                {
                   $cr++;
                }
          }
          
       $this->allsups[$implodeArr] = $cr;
       
      return $cr;
    }

    
    private function combine($arr1, $arr2)
    { 
       $result = array();
       
       $num  = count($arr1);
       $num1 = count($arr2); 
       for($i=0; $i<$num; $i++)
          {
             if(!isset($result['k'][$arr1[$i]]))
             if(!isset($result['k'][$arr1[$i]]))
                {
                   $result['v'][] = $arr1[$i];
                   $result['k'][$arr1[$i]] = 1;
                }
          }

       for($i=0; $i<$num1; $i++)
          {
             if(!isset($result['k'][$arr2[$i]]))
                {
                   $result['v'][] = $arr2[$i];
                   $result['k'][$arr2[$i]] = 1;
                }
          }
      
      return $result['v'];
    } 
    
    /**
        1. نام آیتم را با توجه به شناسه آیتم یا آیتمها بر می گرداند
           {1,2,3,4} => {A,B,C,D}
    **/
    private function realName($arr)
    { 
       $result = ''; 
       
       $num = count($arr);
       for($j=0; $j<$num; $j++)
          { 
             if($j)
               {
                  $result .= $this->delimiter;
               }
                  
             $result .= $this->keys['k->v'][$arr[$j]]; 
          }
      
      return $result;
    }

    //1-2=>2-3 : false
    //1-2=>5-6 : true
    private function checkRule($a, $b)
    { 
       $a_num = count($a); 
       $b_num = count($b); 
       for($i=0; $i<$a_num; $i++) 
          { 
             for($j=0; $j<$b_num; $j++) 
                {
                   if($a[$i]==$b[$j])
                      {
                         return false;
                      }
                }
          }

      return true;
    } 

    private function confidence($sup_a, $sup_ab)
    {
        return round(($sup_ab / $sup_a) * 100, 2);
    }
  
    private function subsets($items) 
    {  
       $result  = array(); 
       $num     = count($items); 
       $members = pow(2, $num); 
       for($i=0; $i<$members; $i++) 
          { 
             $b   = sprintf("%0".$num."b", $i); 
             $tmp = array();  
             for($j=0; $j<$num; $j++) 
                { 
                   if($b[$j]=='1') 
                      {  
                         $tmp[] = $items[$j];   
                      }
                } 
      
             if($tmp)
                { 
                   sort($tmp);
                   $result[] = $tmp; 
                }  
          } 
   
      return $result; 
    }
    
   
    private function freqItemsets($db)
    { 
       $this->fiTime = $this->startTimer();  
       $this->makeTable($db);   
       while(1)
          {
             if($this->phase>=$this->maxPhase)
                {
                   break;
                }
                
             $num = count($this->allthings[$this->phase]);
             $cr  = 0;
             for($i=0; $i<$num; $i++)  
                {    
                   for($j=$i; $j<$num; $j++) 
                      {  
                         if($i==$j)
                            {
                               continue;
                            }
                     
                         $item = $this->combine($this->allthings[$this->phase][$i], $this->allthings[$this->phase][$j]); 
						 
                         sort($item);  
                         $implodeArr = implode($this->delimiter, $item);
                         if(!isset($this->freqItmsts[$implodeArr]))
                            {
                               $sup = $this->scan($item, $implodeArr);
                               if($sup>=$this->minSup)
                                  {
                                     $this->allthings[$this->phase+1][] = $item;
                                     $this->freqItmsts[$implodeArr] = 1;
                                     $cr++;
                                  }
                            } 
                      }
                }
       
             if($cr<=1)
                {
                   break;
                }
      
             $this->phase++;  
          } 
           
       //زیر مجموعه های مربوط به مجموعه های بزرگتر را حذف می کند 
       foreach($this->freqItmsts as $k => $v)
          {
             $arr = explode($this->delimiter, $k);
             $num = count($arr); 
             if($num>=3)
                { 
                   $subsets = $this->subsets($arr);  
                   $num1    = count($subsets); 
                   for($i=0; $i<$num1; $i++)
                      {
                         if(count($subsets[$i])<$num)
                            {
                               unset($this->freqItmsts[implode($this->delimiter, $subsets[$i])]);   
                            } 
                         else
                            {
                               break;
                            }
                      }
                } 
          }
     
       $this->fiTime = $this->stopTimer($this->fiTime); 
    }
    
    /**
        1. قوانین نهایی را با توجه به مقدار حداقل کانفیندس محاسبه می کند
    **/
    public function process($db)
    {
       $checked = $result = array();     
       
       $this->freqItemsets($db);
       $this->arTime = $this->startTimer();
      
       foreach($this->freqItmsts as $k => $v)
          { 
             $arr     = explode($this->delimiter, $k); 
             $subsets = $this->subsets($arr);    
             $num     = count($subsets); 
             for($i=0; $i<$num; $i++)
                {
                   for($j=0; $j<$num; $j++)
                      {
                         if($this->checkRule($subsets[$i], $subsets[$j]))
                            {
                               $n1 = $this->realName($subsets[$i]);
                               $n2 = $this->realName($subsets[$j]);
                                     
                               $scan = $this->scan($this->combine($subsets[$i], $subsets[$j]));
                               $c1   = $this->confidence($this->scan($subsets[$i]), $scan);
                               $c2   = $this->confidence($this->scan($subsets[$j]), $scan); 
                              
                               if($c1>=$this->minConf)
                                  {
                                     $result[$n1][$n2] = $c1; 
                                  }
                                 
                               if($c2>=$this->minConf)
                                  { 
                                     $result[$n2][$n1] = $c2; 
                                  } 
                                             
                               $checked[$n1.$this->delimiter.$n2] = 1;
                               $checked[$n2.$this->delimiter.$n1] = 1; 
                            }
                      }
                } 
          }
      
       $this->arTime = $this->stopTimer($this->arTime); 
 
      return $this->rules = $result;
    }
    
    public function printFreqItemsets()
    {
       echo 'Time: '.$this->fiTime.' second(s)<br />===============================================================================<br />';
         
       foreach($this->freqItmsts as $k => $v)
          {
             $tmp  = '';
             $tmp1 = '';
             $k    = explode($this->delimiter, $k);
             $num  = count($k);
             for($i=0; $i<$num; $i++)
                {  
                   if($i)
                      {
                         $tmp  .= $this->delimiter.$this->realName($k[$i]);
                         $tmp1 .= $this->delimiter.$k[$i];
                      }
                   else
                      {
                         $tmp  = $this->realName($k[$i]);
                         $tmp1 = $k[$i];
                      } 
                }
             
             echo '{'.$tmp.'} = '.$this->allsups[$tmp1].'<br />'; 
          }
    }   
    
    public function saveFreqItemsets($filename)
    {
       $content = '';
                
       foreach($this->freqItmsts as $k => $v)
          {
             $tmp  = '';
             $tmp1 = '';
             $k    = explode($this->delimiter, $k);
             $num  = count($k);
             for($i=0; $i<$num; $i++)
                {  
                   if($i)
                      {
                         $tmp  .= $this->delimiter.$this->realName($k[$i]);
                         $tmp1 .= $this->delimiter.$k[$i];
                      }
                   else
                      {
                         $tmp  = $this->realName($k[$i]);
                         $tmp1 = $k[$i];
                      } 
                }
             
             $content .= '{'.$tmp.'} = '.$this->allsups[$tmp1]."\n"; 
          }
          
        file_put_contents($filename, $content);
    }
    
    public function getFreqItemsets()
    {
       $result = array();
       
       foreach($this->freqItmsts as $k => $v)
          {
             $tmp        = array();
             $tmp['sup'] = $this->allsups[$k];
             $k          = explode($this->delimiter, $k);
             $num        = count($k);
             for($i=0; $i<$num; $i++)
                {  
                   $tmp[] = $this->realName($k[$i]); 
                }
             
             $result[] = $tmp; 
          }
       
      return $result;
    } 
    
    public function printAssociationRules()
    {
       echo 'Time: '.$this->arTime.' second(s)<br />===============================================================================<br />';
        
       foreach($this->rules as $a => $arr)
          {
             foreach($arr as $b => $conf)
                { 
                   echo "$a => $b = $conf%<br />";
				   
                }
          }
    }

    public function saveAssociationRules($filename)
    {

$host = "localhost";
$username = "root";
$password = "kaustubh143";
$db1="recommdata";
$conn1=mysqli_connect($host, $username, $password,$db1);
if(!$conn1)
{
	die ("connection failure:".mysqli_connect_error());
}


	
        $content = '';
                
       foreach($this->rules as $a => $arr)
          {
             foreach($arr as $b => $conf)
                { 
                   $content .= "$a => $b = $conf%\n";
         
			    }
				
		$sqlis="INSERT INTO apr values('$a','$b','$conf') ";
		mysqli_query($conn1,$sqlis);
		
          } 
          
        file_put_contents($filename, $content);
	

		    }
    
    public function getAssociationRules()
    {
        return $this->rules;
    } 
    
    private function startTimer()
    {
       list($usec, $sec) = explode(" ", microtime());
       return ((float)$usec + (float)$sec);
    }
    
    private function stopTimer($start, $round=2)
    {
       $endtime = $this->startTimer()-$start;
       $round   = pow(10, $round);
       return round($endtime*$round)/$round;
    }
	private function timespent()
	{
$host='localhost';
$servername="mysql wampserver";
$username="root";
$passwrd="kaustubh143";
$db1="data";
$conn1=mysqli_connect($host, $username, $passwrd,$db1);
$sqli1= "SELECT tim FROM sessions GROUP BY mac ORDER BY tim  DESC LIMIT 1";
 
 if($result=mysqli_query($conn1,$sqli1))
 {
  while ($row=mysqli_fetch_array($result))
  {
	  $res=$row['tim'];
	  echo $res.PHP_EOL;
  }
	 
	 
 }
 $sqli2= "SELECT tim FROM sessions GROUP BY mac ORDER BY tim ASC LIMIT 1";
if($result=mysqli_query($conn1,$sqli2))
 {
  while ($row=mysqli_fetch_array($result))
  {
	  $res1=$row['tim'];
	  echo $res1.PHP_EOL;
  }
 }
 $tims=$res-$res1;
 echo $tims;
	}
}  
?>
