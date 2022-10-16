<?php 
require "database.php";
require "model/question.php";
require "model/category.php";

session_start();
if(!isset($_SESSION['user_id'])) {
    echo "Variable user_id is not defined";
    header('Location:index.php');
    exit();
}
$result = Question::selectAll();

if(!$result) {
    echo "Error";
    die();
}
if($result->num_rows==0) {
    echo "No Q&A found";
    die();
}
else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>LearnIT Flashcards</title>

    <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>
  <div style="color: black;" class="mt-4 p-5 bg-primary text-white rounded"><h1>LearnIT Flashcards</h1></div> 

  <div class="accordion" id="accordionExample">
  <?php while($row = $result->fetch_array()) : ?>
  <div class="accordion-item">
    <h2 class="accordion-header" id="question_<?php echo $row["id"] ?>">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#answer_<?php echo $row["id"] ?>" aria-expanded="false" aria-controls="collapseOne">
      <?php echo $row["question"] ?>
      </button>
    </h2>
    <div id="answer_<?php echo $row["id"] ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <?php echo $row["answer"] ?>

      </div>
    </div>
  </div>
  <?php endwhile; } ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>