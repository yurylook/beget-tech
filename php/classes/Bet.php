<?php

class Bet{

  public static function updateBet(){
    global $mysqli;
	$id_user=$_SESSION['id'];
	//$id_user=trim($_POST['id_user']);
    $liga = mb_strtolower(trim($_POST['liga']));
    $team1 = mb_strtolower(trim($_POST['team1']));
    $team2 = mb_strtolower(trim($_POST['team2']));
    $bet = trim($_POST['bet']);
    $score = trim($_POST['score']);
    $coeff = trim($_POST['coeff']);
    $summa = trim($_POST['summa']);
    $win = trim($_POST['win']);

    $mysqli -> query("INSERT INTO `bet`(`id_user`,`liga`, `team1`, `team2`, `bet`, `score`, `coeff`, `summa`, `win`) VALUES ('$id_user','$liga','$team1','$team2','$bet', '$score', '$coeff', '$summa', '$win')");
    echo "200";



  }
   public static function selectBet(){
    global $mysqli;
	$id_user=$_SESSION['id'];
	 $liga = mb_strtolower(trim($_POST['liga']));
	 $team = mb_strtolower(trim($_POST['team']));
	 $bet = trim($_POST['bet']);
	 $score = trim($_POST['score']);
	 $coeff = trim($_POST['coeff']);
	 $summa = trim($_POST['summa']);
	 $win = trim($_POST['win']);

	$result = $mysqli->query("SELECT * FROM `bet` WHERE `id_user`='$id_user' AND (`liga`='$liga' OR `team1` = '$team' OR `team2` = '$team' OR
	`bet`='$bet' OR `score` = '$score' OR `coeff` < '$coeff' OR +`summa` < +'$summa' OR `win` > '$win')");
	 $totals = json_encode($result->fetch_all(MYSQLI_ASSOC));
	 echo $totals;
   }
}
?>
