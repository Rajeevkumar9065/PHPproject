<div class="container">
<h1 class="heading text-center">Signup</h1>

    <form method="post"  action="./server/requests.php" >
        <div class="col-6 offset-sm-3 mb-3">
            <label for="username"  class="form-label">User Name</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="enter user name">
        </div>
        <div class="col-6 offset-sm-3 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="enter user email">
        </div>
        <div class="col-6 offset-sm-3 mb-3">
            <label for="password" class="form-label">User Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="enter user password">
        </div>
        <div class="col-6 offset-sm-3 mb-3">
            <label for="address" class="form-label">User Address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="enter user address">
        </div>
        <div class="col-6 offset-sm-3 mb-3">
            <button type="submit"  name="signup" class="btn btn-primary">SignUp</button>
        </div>
    </form>
</div>
