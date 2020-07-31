<?php $this->load->view('header'); ?>

    <body class="authentication-bg">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center">
                            <a href="<?php echo base_url('user_login'); ?>">
                                <span><img src="assets/images/demo.jpg" alt="" height="100"></span>
                            </a>
                            <p class="text-muted mt-2 mb-4"></p>
                        </div>
                        <div class="card">
                          <?php if ($this->session->flashdata('create_user')) { ?>
                            <div class="text-white bg-success text-center">

                              <?php echo $this->session->flashdata('create_user'); ?>

                            </div>
                          <?php } ?>
                          <?php if ($this->session->flashdata('login_faild')) { ?>
                            <div class="text-white bg-danger text-center">

                              <?php echo $this->session->flashdata('login_faild'); ?>

                            </div>
                          <?php } ?>
                          <?php if ($this->session->flashdata('errors')) { ?>
                            <div class="text-white bg-danger text-center">

                              <?php echo $this->session->flashdata('errors'); ?>

                            </div>
                          <?php } ?>

                            <div class="card-body p-4">

                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Sign In</h4>
                                </div>

                                <form action="<?php echo base_url('user_login'); ?>" method="post">

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" name="email" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>
</html>
