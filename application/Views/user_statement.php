<?php

include "header.php";
include "sidebar.php";
?>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->

                <!-- [ breadcrumb ] end -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Expense Table</h5>
                                        <span class="d-block m-t-5">expense <code>information</code> table</span>
                                    </div>
                                    <div class="card-block table-border-style">
                                        <form id="userExpense">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="0">All</option>
                                                        <option value="custom">Custom</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="date" name="from" id="from" class="form-control">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="date" name="to" id="to" class="form-control">
                                                </div>
                                            </div>
                                            <button class="btn btn-danger float-center m-3" id="addNew" type="submit"> <i class="fas fa-plus"></i>Add New Transaction</button>

                                        </form>
                                        <div class="table-responsive" id="printArea">
                                            <img width="100%" height="300px" src="../Views/image.png" style="justify-content: center;">
                                            <table class="table" id="userTable">
                                                <thead>

                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <button class="btn btn-success" id="printStatement"><i class="fas fa-print"></i> Print</button>
                                        <button class="btn btn-info" id="exportStatement"><i class="fas fa-file"></i> Export</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
include "footer.php";
?>
<script src="../Js/user_statement.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>