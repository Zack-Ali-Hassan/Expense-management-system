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
                                        <div class="table-responsive">
                                            <button class="btn btn-danger float-right" id="addNew"> <i class="fas fa-plus"></i>Add New Transaction</button>
                                            <table class="table" id="expenseTable1">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Amount</th>
                                                        <th>Type</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                            <div class="modal" tabindex="-1" id="expenseModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Transaction info</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="expenseForm1">
                                                                <input type="hidden" name="UpdateExpenseHidden" id="UpdateExpenseHidden">
                                                                <div class=" row">
                                                                    <div class="col-sm-12">
                                                                        <div class="alert alert-success d-none" role="alert" id="alertSuccess">
                                                                            This is a success alert—check it out!
                                                                        </div>
                                                                        <div class="alert alert-danger d-none" role="alert" id="alertDanger">
                                                                            This is a danger alert—check it out!
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Amount</label>
                                                                            <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Type</label>
                                                                            <select name="type" class="form-control" id="type">
                                                                                <option value="Income">Income</option>
                                                                                <option value="Expense">Expense</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="for-group">
                                                                            <label for="name">Description</label>
                                                                            <input type="text" name="description" class="form-control" id="description" placeholder="Enter Description">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" id="expenseSaveChange">Save changes</button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <form action="" id="expenseForm">
                                        </form>
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
<script src="../Js/expense.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>