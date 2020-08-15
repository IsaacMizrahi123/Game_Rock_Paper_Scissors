<?php

// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}else{
	$name = $_GET['name'];
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

// Set up the values for the game...
// 0 is Rock, 1 is Paper, and 2 is Scissors
$names = array('Rock', 'Paper', 'Scissors');
$human = isset($_POST["human"]) ? $_POST['human']+0 : -1;

$computer = rand(0,2);

function check($computer, $human) {
    if ($computer == $human) {
    	return "Tie";
    }elseif ( ($computer==0 && $human==2) || ($computer==1 && $human==0) || ($computer==2 && $human==1) ) {
    	return "You Lose";
    }else{
    	return "You win";
    }
}

$result = check($computer, $human);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Playing Rock Paper Scissors Isaac Palacio</title>
</head>
<body>

<h1>Rock Paper Scissors</h1>
<p><?= $name?>, make your desition and play!</p>
<form method="POST">
	<select name="human">
		<option value="-1">Select</option>
		<option value="0">Rock</option>
		<option value="1">Paper</option>
		<option value="2">Scissors</option>
		<option value="3">Test</option>
	</select>
	<button type="submit">Play</button>
	<button type="submit" name="logout">Logout</button>
</form>

<pre>
<?php
if ( $human == -1 ) {
    print "Please select a strategy and press Play.\n";
} else if ( $human == 3 ) {
    for($c=0;$c<3;$c++) {
        for($h=0;$h<3;$h++) {
            $r = check($c, $h);
            print "Human=$names[$h] Computer=$names[$c] Result=$r\n";
        }
    }
} else {
    print "Your Play=$names[$human] Computer Play=$names[$computer] Result=$result\n";
}
?>
</pre>

</body>
</html>