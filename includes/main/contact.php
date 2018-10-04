
<!DOCTYPE html>
<html>
<head>
<title>ChrisDonBot</title>
<link rel="stylesheet" type="text/css" href="../../css/default.css"/>
<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css"/>
<script type="text/javascript" src="../../js/library/jquery.js" ></script>
<script type="text/javascript" src="../../js/library/jquery-ui.js"></script>
<script type="text/javascript" src="../../js/custom/jqscript.js"></script>
<script type="text/javascript" src="../../js/library/gjquery.js"></script>
<script type="text/javascript" src="../../js/library/jquery.flot.js"></script>

<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
</script>
</head>
<body>

<div class="dscmscontainer">
	<div class="dscmswrapper">
		<?php 
			$globalPath = "../";
			include("{$globalPath}main/header.php");
		?>
		<div class="pagecontent">
			<div id="contact-page">
				<h2 class="hdr-text">Contact Author</h2>
				<div id="contact-author">
					<p class="text">Christopher M Coballes</p>
					<p class="text">Master of Information System</p>
					<p class="text">Telephone: +63 2 4737560</p>
					<p class="text">E-mail: cobecoballes@gmail.com</p>
				</div>
				<br/>
				<h2 class="hdr-text">Contact UPOU </h2>
				<div id="contact-upou">
					<p class="text">Faculty of Information & Computer Studies</p>
					<p class="text">University of the Philippines-Open University</p>
					<p class="text">Telephone: +63 2 4737560</p>
					<p class="text">E-mail: contact.upou@up.edu.ph</p>
					
				</div>
			</div>
			<div id="call_32" style="width:20%;background-color:#0094ff">
                <script type="text/javascript">
                Skype.ui({
                    name: "call",
                 element: "call_32",
             participants: ["echo123"],
                imageSize: 15,
               imageColor: "white"
                     });
    </script>
</div>

		</div>
	</div>
</div>
   <div class='footer'  style="margin-top:25%"></div>	
</body>
</html>
