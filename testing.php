<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form method="post">
    <input type="text" name="name" placeholder="Enter your name">
    <input type="text" name="email" placeholder="Enter your email">
    <input type="text" name="phone" placeholder="Enter your phone">
    <input type="submit" name="generate_pdf" value="Generate PDF">
  </form>

  <?php 
    if(isset($_POST['generate_pdf'])){
      ob_end_clean();
      require('fpdf186/fpdf.php'); 
      
      // Instantiate and use the FPDF class 
      $pdf = new FPDF(); 
      
      //Add a new page 
      $pdf->AddPage(); 
      
      // Set the font for the text 
      $pdf->SetFont('Arial', 'B', 18); 
      
      // Prints a cell with given text 
      $pdf->Cell(0, 10, $_POST['name'], 1, 1, 'C');
      $pdf->Cell(40, 10, $_POST['email']);
      $pdf->Cell(40, 10, $_POST['phone']);
      
      // return the generated output 
      $pdf->Output();
    }
  ?>
  
</body>
</html>