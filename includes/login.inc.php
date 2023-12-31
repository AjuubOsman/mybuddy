<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
                    <?php
                        if (isset($_SESSION['melding']))
                        {
                            echo $_SESSION['melding'];
                            unset($_SESSION['melding']);
                        }

                    ?>

                    <form action="php/login.php" method="post">
                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>


                        <div class="d-grid">
                            <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
                                in</button>

                        </div>
                    </form>

                        <hr class="my-4">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-login text-uppercase fw-bold" onclick="window.location.href='index.php?page=register'" type="submit">Sign
                                up</button>

                        </div>


                </div>
            </div>
        </div>
    </div>
