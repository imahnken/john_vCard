<?php
	
	ob_start();
	
	/* CONTACT FORM */
	/* Edit the send_to line below */
	$send_to = 'abogawat@gmail.com';
	/* Do not need to edit anything beyond this line */
	/* For more Contact forms, visit CodeCanyon */
	
	
	$hasErrors = false;
	// Check if name, email and message are filled out.
	if(empty($_POST["cf_name"]) || empty($_POST["cf_email"]) || empty($_POST["cf_message"]))
	{
		$hasErrors = true;
	}else{
		// Check if email is a valid email
		if(preg_match("/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/", $_POST["cf_email"]) == 1) {
			$hasErrors = false;
		}else{
			$hasErrors = true;
		}
	}
	
	// email_2 is a HIDDEN dummy field
	// If this is filled out, it's spam, proceed if it's empty...
	if(empty($_POST["email_2"]))
	{
		if($hasErrors == false)
		{
			// Include an excerpt in the subject line
			$excerpt = " " . substr(stripslashes($_POST["cf_message"]), 0, 20) . "...";
			$to = $send_to; // pulled from above to make it easier to edit.
			$from = $_POST["cf_email"];
			$subject = 'Contact Form - ' . $excerpt;
			$headers = "From: ".$from." \r\n" .
			"Reply-To: ".$_POST["cf_email"];
			$body = "\nContact Form Message:\n\n";
			$body .= "From: " . $_POST["cf_name"] . " (".$_POST['cf_email'].")\n";
			$body .= "Email: " . $_POST["cf_email"] . "\n";
			$body .= "Phone: " . $_POST["cf_phone"] . "\n";
			$body .= "\nMessage:\n" . stripslashes($_POST["cf_message"]) . "\n\n";
			$body .= "IP: ". $_SERVER['REMOTE_ADDR'] . "\n";
			$body .= "". $_SERVER['SERVER_NAME'] . "\n";
			mail($to,$subject,$body,$headers);
		}
	}else{ 
		//email_2 is SPAM
	}
	?>
	
	<?php 
		if( $hasErrors == false ) { 
			header("Location: index.html");
		}else{
			echo "<p style='text-align:center; background:#900; color:#fff; padding:20px; margin:100px;'>You did not enter all fields in the form. Please go back and try again.</p>";
		} 
		
		ob_end_flush();
?>