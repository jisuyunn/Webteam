<?
	try{
		$db = new PDO("mysql:dbname=member;host=localhost","root","apmsetup");
		
		$newID = $_POST["uID"];
		$newID = $db->quote($newID);

		$newPW = $_POST["uPW"];	
		$newPW = $db->quote($newPW);

		$newGender = $_POST["gender"];
		$newGender = $db->quote($newGender);

		$newcell = $_POST["first"].$_POST["middle"].$_POST["last"];
		$newcell = $db->quote($newcell);

		for($i=0; $i<4; $i++){
			if(isset($_POST["leisure$i"]))
				$newhobby=$_POST["leisure$i"].", ";
		}

		$newhobby = $db->quote($newhobby);

		$newaddress = $_POST["uaddress"];
		$newaddress = $db->quote($newaddress);

		$newintro = $_POST["introduce"];
		$newintro = $db->quote($newintro);

		$query = "INSERT INTO MEMBER VALUES($newID, $newPW, $newGender, $newcell, $newaddress, $newhobby, $newintro)";
		$result = $db->exec($query);

	}catch(PDOExeption $ex){
		?>
		<p>에러 발생</p><?=$ex->getMessage()?>
		<?
	}

	?>
	<h2 style = "text-align: center">입력하신 정보는 다음과 같습니다.</h2>
	<?
		$addrows = $db->query("SELECT * FROM member WHERE id = $newID");
		$addrow = $addrows->fetch();
		?>
		<table border = 1 cellspacing = 0 style = "margin: 0 auto;">
		  <tr>
		  	<th>아이디</th>
		  	<th>성별</th>
		  	<th>핸드폰번호</th>
		  	<th>취미</th>
		  </tr>
		  <tr>
			<td><?=$addrow["id"]?></td>
			<td><?=$addrow["gender"]?></td>
			<td><?=$addrow["cell"]?></td>
			<td><?=$addrow["hobby"]?></td>
		  <tr>
		</table>		
		<h5 style = "text-align: center">[자기소개]</h5>
		<p style = "text-align: center"><?=$addrow["intro"]?></p>
		<?
	?>
	<br><br><hr><br><br>
	<h1 style = "text-align: center">전체 데이터</h1>
	<?
	$rows = $db->query("SELECT * FROM member;");
	foreach($rows as $row){
		?>
		<table border = 1 cellspacing = 0 style = "margin: 0 auto;">
		  <tr>
		  	<th>아이디</th>
		  	<th>성별</th>
		  	<th>핸드폰번호</th>
		  	<th>취미</th>
		  </tr>
		  <tr>
			<td><?=$row["id"]?></td>
			<td><?=$row["gender"]?></td>
			<td><?=$row["cell"]?></td>
			<td><?=$row["hobby"]?></td>
		  <tr>
		</table>		
		<br><br>
		<?
	}
?>