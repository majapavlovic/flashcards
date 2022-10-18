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
  </style>
</head>
<body>
  <div style="color: black;" class="mt-4 p-5 bg-primary text-white rounded"><h1>LearnIT Flashcards</h1></div> 

  <div class="row">
    <div class="col-md-2">
      <div class="btn-group-vertical">
        <div class="btn-group">
          <button type="button" class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#modal-insert">Add a question</button>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-secondary btn-lg">Edit a question</button>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-secondary btn-lg">Delete a question</button>
        </div>
      </div>
    </div>
    <div class="col">

      <div class="accordion" id="accordionExample">
        <?php while($row = $result->fetch_array()) : ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id="question_<?php echo $row["id"] ?>">
            <button class="accordion-button" style="font-size:xx-large;" type="button" data-bs-toggle="collapse" data-bs-target="#answer_<?php echo $row["id"] ?>" aria-expanded="false" aria-controls="collapseOne">
            <div class="custom-radio-btn" id="radio-questions">
              <input type="radio" name="checked-donut" value=<?php echo $row["id"] ?>>
              <span class="checkmark"></span>&nbsp;
            </div>
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
    </div>
  </div>

  <?php 
  $categories_list = Category::selectAll();
  ?>
  
<!-- Modal -->
<div class="modal fade" id="modal-insert" role="dialog" >
    <div class="modal-dialog">

        <!--Sadrzaj modala-->
        <div class="modal-content" >
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="modal-body">
                <div class="container prijava-form">
                    <form action="#" method="post" id="insert-question">
                        <h3 style="color: black; text-align: center" >Insert Question&Answer</h3>
                        <div class="row">
                            <div class="col-md-11 ">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea class="form-control" style="border: 1px solid black" id="question" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="answer">Answer</label>
                                    <textarea class="form-control" style="border: 1px solid black" id="answer" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>                                    
                                    <select class="form-select" id="select-categories" onChange="javascript: console.log('blabla');">
                                    <?php 
                                      if($categories_list->num_rows==0) {
                                    ?>
                                    <option selected>Error loading categories</option>
                                    <?php } else { ?>
                                    <option selected>Choose category</option>
                                    <?php while($row = $categories_list-> fetch_array()) : ?>
                                      <option value="<?php echo $row["id"]?>"><?php echo $row["category_name"]?></option>
                                    <?php endwhile; } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <button id="btn-insert" type="submit" class="btn btn-success btn-block"
                                    tyle="background-color: orange; border: 1px solid black;">Save</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>