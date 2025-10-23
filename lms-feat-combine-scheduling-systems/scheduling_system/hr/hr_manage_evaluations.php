<?php include '../templates/header.php'; ?>
<?php include '../templates/hr_sidebar.php'; ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">Manage Employee Evaluations</h3>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Completed Evaluations</h4>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Employee ID</th>
                                            <th>Evaluation Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Evaluation records will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include '../templates/footer.php'; ?>
