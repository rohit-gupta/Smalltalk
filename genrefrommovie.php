<?php
function genres($var)
{
	$file=fopen("genres.txt","r");
	$genre=array();
	$unseen=array();
	foreach($var as $movie)
	{
		while(!feof($file))
		{
			$l=fgets($file);
			$line=explode("\t",$l);
			$line[1]=trim($line[1]);
			$line[0]=trim($line[0]);
			if(stristr($line[0],$movie['name'])!=FALSE) 
				$genre[]=$line[1];
			else
			{
				$unseen[$line[1]][]=$line[0];
			}
			
		}
	}
	if($genre==NULL)
	return -1;
	$size=count($genre);
	$max=0;
	$c=0;
	$pos=0;
	for($i=0;$i<$size;$i++)
	{
		for($j=$i;$j<$size;$j++)
			if($genre[$i]==$genre[$j])
				$c++;
		if($c>$max){$max=$c;$pos=$i;}
	}
	$unseen[$genre[$pos]][]=$genre[$pos];
	return $unseen[$genre[$pos]];
}
?>
