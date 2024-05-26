<!-- Modal
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup to iDiscuss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            
        </div>
    </div>
</div> -->


<!-- new -->
<!-- Button trigger modal -->
 

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/forum/partials/_handleSignup.php" >
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="signUpEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signUpEmail" name="signUpEmail" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="emailPassword" class="form-label">Password</label>
                        <input type="password" id="emailPassword" name="emailPassword" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="emailCPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="emailCPassword" name="emailCPassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form> ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>