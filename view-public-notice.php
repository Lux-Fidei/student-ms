<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!doctype html>
<html>
<head>
    <title>Student Management System || Notice</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .memorandum {
            background-color: #f2f2f2;
            padding: 50px 0;
        }
        .memorandum .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .memorandum h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .memorandum table {
            width: 100%;
            border-collapse: collapse;
        }
        .memorandum table th, .memorandum table td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .memorandum table th {
            background-color: #f2f2f2;
            font-weight: normal;
        }
		.h4{
			line-height: 0;
			margin-top:-5px;

		}
    </style>
</head>
<body>
<?php include_once('includes/header.php');?>
<div class="banner banner5">
    <div class="container">
		
        <h2>Notice</h2>
    </div>
</div>
<!-- Memorandum -->
<div class="memorandum">
    <div class="container">
     <header>
	  <div>
		<div>
    	   </div>
		   <div>

		   </div>
		   <div style="display: flex; justify-content: center">
			<div style="display: flex; justify-content: justify-between;">
					<img src="images/MarawiSeniorHigh-removebg.png" alt="Logo" width="128px" ratio="1" style="margin-right: 16px">
					<div>
					<h4 style="text-align: center; font-family:'Times New Roman' , Times, serif; line-height: 0;
				margin-top:-5px; font-size:medium">Republic of the Philippines</h4>
					<h4 style="text-align: center; font-family:'Times New Roman' , Times, serif; line-height: 0;
						margin-top:-5px;">Mindanao State University</h4>
					<h4 style="text-align: center; font-family:'Times New Roman', Times, serif;line-height: 0;
						margin-top:-5px;"> Senior High School</h4>
					<h4 style="text-align: center; font-family:'Times New Roman', Times, serif;line-height: 0;
						margin-top:-5px;font-size:medium">Marawi City</h4>
					</div>
					<img src="images/GRADIENT.png" alt="Logo" width="96px" style="margin-left: 18px">
				</div>
		   </div>
				
              </div>
              <div>
                <hr style="border-color:black; border:1px solid gold; margin-top: 4px; width: 100%" />
              </div>
	</header>
			
        <table>
		<h4 style="text-align: center; font-family:'Times New Roman' , Times, serif; line-height: 0;
			margin-top:-5px; font-size:larger"></h4>

            <?php
            $vid=$_GET['viewid'];
            $sql="SELECT * from tblpublicnotice where ID=:vid";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':vid',$vid,PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0) {
                foreach($results as $row) { ?>
                    <tr>
                        <th>Announced Date</th>
                        <td><?php echo $row->CreationDate;?></td>
                    </tr>
                    <tr>
                        <th>Notice Title</th>
                        <td><?php echo $row->NoticeTitle;?></td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td><?php echo $row->NoticeMessage;?></td>
                    </tr>
            <?php $cnt=$cnt+1;}} ?>
        </table>
    </div>
</div>
<!-- /Memorandum -->

<!--/copy-rights-->
<!-- JavaScript files -->
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/modernizr.custom.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){     
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
        });
    });
</script>
</body>
</html>
