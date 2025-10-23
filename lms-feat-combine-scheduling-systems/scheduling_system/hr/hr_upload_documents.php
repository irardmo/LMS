<?php include '../templates/header.php'; ?>
<?php include '../templates/hr_sidebar.php'; ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">Upload Employee Documents</h3>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Employee Documents</h4>
                                <form class="forms-sample">
                                    <div class="form-group row">
                                        <label for="employeeNameUpload" class="col-sm-3 col-form-label">Employee Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="employeeNameUpload" placeholder="Employee Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Requirements Checklist</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"> Police Clearance
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"> Good Moral Certificate
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"> NBI Clearance
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"> SSS ID
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>File upload</label>
                                        <input type="file" name="img[]" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span>
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
