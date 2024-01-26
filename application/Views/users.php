<?php

include "header.php";
include "sidebar.php";
?>
<style>
    #show {
        width: 150px;
        height: 150px;
        border: solid 1px black;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
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
                                        <h5>User Table</h5>
                                        <span class="d-block m-t-5">User <code>information</code> table</span>
                                    </div>
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                            <button class="btn btn-danger float-right" id="addNew"> <i class="fas fa-plus"></i>Add New User</button>
                                            <table class="table" id="userTable1">
                                                <thead>

                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                            <div class="modal" tabindex="-1" id="userModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">User info</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="userForm1" enctype="multipart/form-data">
                                                                <input type="hidden" name="UpdateUsereHidden" id="UpdateUserHidden">
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
                                                                        <input type="hidden" name="update_id" class="form-control" id="update_id" placeholder="Enter Username">

                                                                        <div class="form-group">
                                                                            <label for="name">Username</label>
                                                                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Password</label>
                                                                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Image</label>
                                                                            <input type="file" name="image" class="form-control" id="image" placeholder="Enter Image">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-3"></div>
                                                                    <div class="col-sm-8">
                                                                        <div class="form-group ">
                                                                            <img src="" id="show">
                                                                            <!-- <img src="" class="user_image" alt=""> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" id="userSaveChange">Save changes</button>
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
<script src="../Js/users.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>