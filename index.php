<?php
session_start();

if(isset($_POST['region'])&& $_POST['region'] != null)
$_SESSION['region'] = $_POST['region'];
class singleton{
	static function getDBConnection(){
		static $pdo = null;
        if (null === $pdo) {
        	$dsn = 'mysql:host=localhost;dbname=project1';
		   	$user = 'root';
		  	try {
				$pdo = new PDO($dsn, $user);
				$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			}
			catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
        }
    return $pdo;
	}

	


}
class Regions{
	public static function getArray(){
		$regionsName = array("Us Service Schools", 
			"New England CT ME MA NH RI VT",
			"Mid East DE DC MD NJ NY PA",
			"Great Lakes IL IN MI OH WI",
			"Plains IA KS MN MO NE ND SD",
			"Southeast AL AR FL GA KY LA MS NC SC TN VA WV",
			"Southwest AZ NM OK TX",
			"Rocky Mountains CO ID MT UT WY",
			"Far West AK CA HI NV OR WA",
			"Outlying areas AS FM GU MH MP PR PW VI",
			"All US"
			);
		return $regionsName;

	}
}
class byRegion{
	public function __construct(){
		echo '<form action="index.php" method="POST">
		<div align="center">
		<select name="region">
		<option value="10">All US</option>
		<option value="0">Us Service Schools</option>
		<option value="1">New England CT ME MA NH RI VT </option>
		<option value="2">Mid East DE DC MD NJ NY PA</option>
		<option value="3">Great Lakes IL IN MI OH WI</option>
		<option value="4">Plains IA KS MN MO NE ND SD</option>
		<option value="5">Southeast AL AR FL GA KY LA MS NC SC TN VA WV</option>
		<option value="6">Southwest AZ NM OK TX</option>
		<option value="7">Rocky Mountains CO ID MT UT WY</option>
		<option value="8">Far West AK CA HI NV OR WA</option>
		<option value="9">Outlying areas AS FM GU MH MP PR PW VI</option>
		<input type="submit" value="submit">

		</select>
		</div>
		</form>';
	}
}
class percentFemale{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the highest percentage of women students</h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
		$sql="select INSTNM,Female_Percent from gender join data on gender.UNITID=data.UNITID order by Female_Percent desc limit 10;";
		else
			$sql="select INSTNM,Female_Percent from gender join data on gender.UNITID=data.UNITID where OBEREG=".$_SESSION['region']." order by Female_Percent desc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>".round($row['Female_Percent'])."%</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
class percentMale{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the highest percentage of male students</h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
		$sql="select INSTNM,Male_Percent from gender join data on gender.UNITID=data.UNITID order by Male_Percent desc limit 10;";
		else
		$sql="select INSTNM,Male_Percent from gender join data on gender.UNITID=data.UNITID where OBEREG=".$_SESSION['region']." order by Male_Percent desc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>".round($row['Male_Percent'])."%</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}

class endowment{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the highest endowment </h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
		$sql="select INSTNM,endowment from endowment join data on endowment.UNITID=data.UNITID order by endowment desc limit 10;";
	    else
		$sql="select INSTNM,endowment from endowment join data on endowment.UNITID=data.UNITID where OBEREG=".$_SESSION['region']." order by endowment desc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>$".number_format($row['endowment'])."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
class enrollment{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the highest enrolled freshmans </h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
		$sql="select INSTNM,Freshman_total from freshman join data on freshman.UNITID=data.UNITID order by Freshman_total desc limit 10;";
		else
		$sql="select INSTNM,Freshman_total from freshman join data on freshman.UNITID=data.UNITID where OBEREG=".$_SESSION['region']." order by Freshman_total desc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>".number_format($row['Freshman_total'])."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
class revenue{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the highest revenue from tuition</h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
		$sql="select INSTNM,Freshman_total from freshman join data on freshman.UNITID=data.UNITID order by Freshman_total desc limit 10;";
		else
		$sql="select INSTNM,Freshman_total from freshman join data on freshman.UNITID=data.UNITID where OBEREG=".$_SESSION['region']." order by Freshman_total desc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>".number_format($row['Freshman_total'])."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
class tuition{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the lowest non zero tuition revenue</h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
			$sql="select INSTNM,F1B01 from tuition join data on tuition.UNITID=data.UNITID where F1B01!='0' order by F1B01 asc limit 10;";
		else
			$sql="select INSTNM,F1B01 from tuition join data on tuition.UNITID=data.UNITID where F1B01!='0' and OBEREG=".$_SESSION['region']." order by F1B01 asc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>$".number_format($row['F1B01'])."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
class tuitionHigh{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the highest  tuition</h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
			$sql="select INSTNM,F1B01 from tuition join data on tuition.UNITID=data.UNITID where F1B01!='0' order by F1B01 desc limit 10;";
		else
			$sql="select INSTNM,F1B01 from tuition join data on tuition.UNITID=data.UNITID where F1B01!='0' and OBEREG=".$_SESSION['region']." order by F1B01 desc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>$".number_format($row['F1B01'])."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}

class assets{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the highest  assets</h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
			$sql="select INSTNM,F1A06 from liability_asset join data on liability_asset.UNITID=data.UNITID order by F1A06 desc limit 10;";
		else
			$sql="select INSTNM,F1A06 from liability_asset join data on liability_asset.UNITID=data.UNITID where OBEREG=".$_SESSION['region']." order by F1A06 desc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>$".$row['F1A06']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
class Liabilites{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the highest  liabilites</h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)   
			$sql="select INSTNM,F1A13 from liability_asset join data on liability_asset.UNITID=data.UNITID order by cast(F1A13 AS UNSIGNED) desc limit 10;";
		else
			$sql="select INSTNM,F1A13 from liability_asset join data on liability_asset.UNITID=data.UNITID where OBEREG=".$_SESSION['region']." order by F1A13 desc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>$".$row['F1A13']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
class Low_tuition{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the lowest  tuition</h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
			$sql="select INSTNM,tuition1 from school_tuition join data on school_tuition.unitid=data.UNITID where tuition1!='0' and tuition1!=''  order by tuition1 asc limit 10;";
		else
			$sql="select INSTNM,tuition1 from school_tuition join data on school_tuition.unitid=data.UNITID where tuition1!='0' and tuition1!='' and OBEREG=".$_SESSION['region']." order by tuition1 asc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>$".$row['tuition1']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
class High_tuition{
	public function __construct(){
		$pdo = singleton::getDBConnection();
		echo "<h3>Colleges with the highest  tuition</h3> ";
		echo "<table>";
		if(isset($_SESSION['region'])&& $_SESSION['region'] ==10)
			$sql="select INSTNM,tuition1 from school_tuition join data on school_tuition.unitid=data.UNITID where tuition1!='0' and tuition1!=''  order by tuition1 desc limit 10;";
		else
			$sql="select INSTNM,tuition1 from school_tuition join data on school_tuition.unitid=data.UNITID where tuition1!='0' and tuition1!='' and OBEREG=".$_SESSION['region']." order by tuition1 desc limit 10;";

		foreach($pdo->query($sql) as $row){
			echo "<tr>";
			echo "<td>".$row['INSTNM']."</td>";
			echo "<td>$".$row['tuition1']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
class menu{
	public function __construct(){
		echo '<a href="?page=percentFemale">Colleges with the highest percentage of women students</a></p>';
		echo '<a href="?page=percentMale">Colleges with the highest percentage of male students</a></p>';
		echo '<a href="?page=endowment">Colleges with the largest endowment overall</a></p>';
		echo '<a href="?page=enrollment">Colleges with the largest enrollment of freshman</a></p>';
		echo '<a href="?page=revenue">Colleges with the highest revenue from tuition</a></p>';
		echo '<a href="?page=tuition">Colleges with the lowest non zero tuition revenue</a></p>';
		echo 'specially for regions';
		echo '<ul>';
		echo '<li><a href="?page=endowment">Endowment</a></p></li>';
		echo '<li><a href="?page=assets">Assets</a></p></li>';
		echo '<li><a href="?page=Liabilites">Liabilites</a></p></li>';
		echo '<li><a href="?page=Low_tuition">Lowest Tuition</a></p></li>';
		echo '<li><a href="?page=High_tuition">Highest Tuition</a></p></li>';


		echo "</ul>";
		
		
	}
}

class title{
	public function __construct(){
		$regions = Regions::getArray();
		echo "<h2>You are currently on : ".$regions[$_SESSION['region']]."</h2>";

	}
}
$title = new title();
$dropdown = new byRegion();
$menu= new menu();




if(isset($_REQUEST['page']))
$display = new $_REQUEST['page'];

?>