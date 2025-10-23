<?php include '../templates/header.php'; ?>
<?php include '../templates/hr_sidebar.php'; ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">Employee Registration</h3>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Employee Information</h4>
                                <form class="forms-sample">
                                    <div class="form-group row">
                                        <label for="firstName" class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="firstName" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="middleName" class="col-sm-3 col-form-label">Middle Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="middleName" placeholder="Middle Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastName" class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="employeeNumber" class="col-sm-3 col-form-label">Employee Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="employeeNumber" placeholder="Employee Number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="position" class="col-sm-3 col-form-label">Position</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="position" placeholder="Position">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include '../templates/footer.php'; ?>
