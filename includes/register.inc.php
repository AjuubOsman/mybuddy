
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-light fs-5">Sign Up</h5>
                    <form action="php/register.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="firstname">
                            <label for="floatingPassword">First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="middlename" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Middle Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="lastname" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Last Name</label>
                        </div>
                        <?php
                        if (isset($_SESSION['melding']))
                        {
                            echo $_SESSION['melding'];
                            unset($_SESSION['melding']);
                        }

                        ?>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="passwordrepeat" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
                                up</button>
                        </div>
                        <hr class="my-4">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-login text-uppercase fw-bold" onclick="window.location.href='index.php?page=login'" type="submit">Sign
                                in</button>

                        </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

