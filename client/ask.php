<div class="container">
<h1 class="heading text-center">Ask A Question</h1>


    <form action="./server/requests.php" method="post" >
       
        <div class="col-6 offset-sm-3 mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="email" placeholder="Enter question">
        </div>
        <div class="col-6 offset-sm-3 mb-3">
            <label for="title" class="form-label">Description</label>
            <textarea   name="description" class="form-control" id="description" placeholder="Enter question"></textarea>
        </div>
        <div class="col-6 offset-sm-3 mb-3">
            <label for="title" class="form-label">Category</label>
       <?php 
       include("category.php")
       ?>
        </div>
        
      
        <div class="col-6 offset-sm-3 mb-3">
            <button type="submit" name="ask" class="btn btn-primary">Ask Question</button>
        </div>
    </form>
</div>
