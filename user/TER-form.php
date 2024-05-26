<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the form is submitted
if (isset($_POST['teacher_name'])) {
    // Retrieve teacher's ID
    $teacher_id = $_POST['teacher_name'];

    // Initialize an array to store evaluation results
    $evaluation_results = array();

    // Fetch questions from the database
    $sql = "SELECT * FROM tbl_ter_questions";
    $query = $dbh->prepare($sql);
    $query->execute();
    $questions = $query->fetchAll(PDO::FETCH_ASSOC);

    // Process each question and its corresponding answer
    foreach ($questions as $question) {
        // Construct the answer variable name based on question ID
        $answer_variable_name = 'q' . $question['ID'];

        // Retrieve the answer for the current question
        if (isset($_POST[$answer_variable_name])) {
            $answer = $_POST[$answer_variable_name];
            // Store the question ID and its corresponding answer
            $evaluation_results[$question['ID']] = $answer;
        }
    }

    // Retrieve the comment
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';

    // Insert evaluation data into the database
    foreach ($evaluation_results as $question_id => $answer) {
        $sql = "INSERT INTO tbl_evaluation (teacher_id, question_id, answer) VALUES (:teacher_id, :question_id, :answer)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $query->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $query->bindParam(':answer', $answer, PDO::PARAM_STR);
        $query->execute();
    }

    // Insert the comment into the database
    if (!empty($comment)) {
        $sql = "INSERT INTO tbl_evaluation_comments (teacher_id, comment) VALUES (:teacher_id, :comment)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $query->bindParam(':comment', $comment, PDO::PARAM_STR);
        $query->execute();
    }

    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            .modal {
                display: block;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
            }
            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 600px;
                text-align: center;
            }
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
    
    <div id='myModal' class='modal'>
      <div class='modal-content'>
        <span class='close'>&times;</span>
        <h2>Thank you for submitting the evaluation!</h2>
        <p>Your feedback has been recorded.</p>
        <p><a href='dashboard.php'>Back to Home</a></p>
      </div>
    </div>
    
    <script>
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName('close')[0];
        span.onclick = function() {
            modal.style.display = 'none';
            window.location.href = 'dashboard.php';
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
                window.location.href = 'dashboard.php';
            }
        }
    </script>
    
    </body>
    </html>
    ";
    exit;
}

// Check if the TER form is active
$isTerActive = true; // Set the initial TER form activation status. Change it as per your requirement.

// If TER form is not active, redirect to a different page or show a message
if (!$isTerActive) {
    echo "<h2>TER form is currently deactivated. Please try again later.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Evaluation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d5d5d5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1276px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px 31px 2em;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            padding: 20px 0;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="radio"] {
            margin-right: 9px;
            display: inline-block;
            margin-bottom: 2em;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            float: right; /* Align to the right */
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
        hr {
            border-color: black;
            border: 1px solid gold;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-style: italic;
            font-family: times;
            font-size: 26px;
            color: black;
            padding: 9px;
        }
        .testament {
            font-weight: bold;
            font-style: italic;
            font-family: 'Times New Roman', Times, serif;
            font-size: larger;
        }

        .btn-primary {
            background-color: #ecd55e;
            border-color: #007bff;
            color: #fffbfb;
            padding: 10px 20px;
            border-radius: 45px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn {
        font-size: 0.875rem;
        line-height: 1;
        font-family: "Open Sans", sans-serif;
        font-weight: 600;
        margin-top: -7em;
        }
    </style>
</head>
<body>
    <div class="header">
        
        <img src="images/GRADIENT.png" alt="Logo"> <!-- Change "logo.png" to the path of your logo -->
        <img src="images/MarawiSeniorHigh-removebg.png" alt="Logo"> <!-- Change "logo.png" to the path of your logo -->
        <div>
            <h4>Republic Of The Philippines</h4>
            <h4 class="university-name">MINDANAO STATE UNIVERSITY</h4>
            <h4 class="school">SENIOR HIGH SCHOOL</h4>
            <h4>Marawi City</h4>
        </div>
    </div>
    <hr></hr>

    <div class="container">
    <a href="dashboard.php" class="btn btn-primary"><</a>
        <h2><i class="bi bi-people"></i> Teacher Efficiency Records</h2>
        <h2 style="background-image: url(images/okirr1.jpg);background-size: contain;">.</h2>

        <form method="post">    
            <label for="teacher_name" style="font-weight: bold;">Select Teacher:</label>
            <select id="teacher_name" name="teacher_name" required>
                <option value="">Select Teacher</option>
                <?php
                $sqlSection = "SELECT section FROM tblstudent WHERE ID = :id";
                $querySection = $dbh->prepare($sqlSection);
                $querySection->bindParam(':id', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                $querySection->execute();
                $section = $querySection->fetch(PDO::FETCH_ASSOC);
                // Fetch teachers from the database
                $sql = "SELECT f.FirstName, f.MiddleInitial, f.LastName
                FROM schedule s
                JOIN tblfaculty f ON s.faculty_id = f.ID
                JOIN enrollments e ON s.schedule_id = e.class_id
                WHERE e.section = :section;
                ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':section', $section['section'], PDO::PARAM_STR);
                $query->execute();
                $teachers = $query->fetchAll(PDO::FETCH_ASSOC);
                
                // Display each teacher as an option in the dropdown
                foreach ($teachers as $teacher) {
                    echo "<option value='".$teacher['ID']."'>".$teacher['FirstName']." ".$teacher['LastName']."</option>";
                }
                ?>
            </select>
            
            <!-- Dynamic generation of questions -->
            <?php 
            // Fetch questions from the database
            $sql = "SELECT * FROM tbl_ter_questions";
            $query = $dbh->prepare($sql);
            $query->execute();
            $questions = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $questionNumber = 1; // Initialize question numbering
            
            foreach ($questions as $question): ?>
                <label><?php echo $questionNumber . '. ' . $question['Question']; ?></label>
                <input type="radio" name="q<?php echo $question['ID']; ?>" value="Always" required> Always
                <input type="radio" name="q<?php echo $question['ID']; ?>" value="Often" required> Often
                <input type="radio" name="q<?php echo $question['ID']; ?>" value="Sometimes" required> Sometimes
                <input type="radio" name="q<?php echo $question['ID']; ?>" value="Seldom" required> Seldom
                <input type="radio" name="q<?php echo $question['ID']; ?>" value="Never" required> Never
                <br> <!-- Add line break for each question -->
                <?php $questionNumber++; ?> <!-- Increment question numbering -->
            <?php endforeach; ?>
            
            <!-- Comment Section -->
            <label for="comment" style="font-weight: bold;">Additional Comments:</label>
            <textarea id="comment" name="comment" rows="4" placeholder="Enter your comments here..."></textarea>
            
            <!-- Testament Section -->
            <div style="margin-top: 20px;">
                <input type="checkbox" id="honesty" name="honesty" value="agree" required>
                <label for="honesty" class="testament"> I hereby declare that the information provided is accurate and given with full honesty and integrity.</label>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Submit Evaluation">
        </form>
    </div>
</body>
</html>
