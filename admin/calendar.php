<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        .header {
            display: flex;
            align-items: center;
            margin-left: 9em;
        }
        .header img {
            max-width: 100px; /* Adjust the size of the logo as needed */
            margin-right: 10px;
        }
        h4 {
            text-align: left;
            margin: 0;
            font-size: 17px;
            font-weight: 300;
            font-family: Arial, Helvetica, sans-serif;
        }
        .table-container {
            width: 80%;
            margin: 20px auto; /* Center the div horizontally */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid black;
        }
        th {
            background-color: #79ab79;
            color: #333;
            font-weight: bold;
            text-align: center;
        }
        td {
            font-weight: normal;
        }
        tr:hover {
            background-color: #f4f4f4;
        }
        .separator {
            border-left: 1px solid black;
        }
        .university-name {
            color: maroon;
            font-size: 20px;
            font-weight: bold;
            font-family: 'Times New Roman', Times, serif;
        }
        .school {
            color: black;
            font-size: 19px;
            font-family: 'Times New Roman', Times, serif;
        }
        .semester {
            text-align: center;
            margin-top: -19px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="images/MSU copy.png" alt="Logo"> <!-- Change "logo.png" to the path of your logo -->
        <img src="images/MarawiSeniorHigh-removebg.png" alt="Logo"> <!-- Change "logo.png" to the path of your logo -->
        <div>
            <h4>Republic Of The Philippines</h4>
            <h4 class="university-name">Mindanao State University</h4>
            <h4 class="school">Senior High School</h4>
            <h4>Marawi City</h4>
        </div>
    </div>
    <hr style="border-color:black;border:1px solid gold"></hr>
    
    <h2>SCHOOL CALENDAR</h2>
    <h4 class="semester">Second Semester SY <?php echo date('Y'); ?></h4> <!-- Fetch the school year -->

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ACTIVITIES</th>
                    <th class="separator"></th>
                    <th>Inclusive Dates/Deadlines</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection file
                include('includes/dbconnection.php');

                // Fetch activity data from the database
                $sql = "SELECT * FROM tbl_activity";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                // Loop through each activity and display it in the table
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['activity_name'] . "</td>";
                    echo "<td class='separator'></td>";
                    
                    // Format the date to include month, day, and year
                    $date = date_create($row['date_allocated']);
                    echo "<td>" . date_format($date, 'F j, Y') . "</td>";
                    
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
