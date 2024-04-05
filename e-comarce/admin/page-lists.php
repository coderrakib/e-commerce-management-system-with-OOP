<?php require_once ("config.php");?>
<!doctype html>
<html lang="en">
 
<head>
    <?php require_once ("include/css.php");
        echo '<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>';
    ?>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <?php require_once ("include/navbar.php");?>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php require_once ("include/leftsidebar.php");?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <?php
  
            $pages = new Pages;
            $pages->getpages();
            $query = $pages->query;
        ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Page Lists </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo 'dashboard.php'; ?>" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo 'page-lists.php'; ?>" class="breadcrumb-link">Page Lists</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h3 class="card-header">All Pages</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Page Name</th>
                                      <th>Page Title</th>
                                      <th>Page Slug</th>
                                      <th>Page Description</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>#</th>
                                      <th>Page Name</th>
                                      <th>Page Title</th>
                                      <th>Page Slug</th>
                                      <th>Page Description</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php 

                                        $sl = 1;

                                        while ($row = $query->fetch_assoc()) { 

                                        $id           = $row['id'];
                                        $name         = $row['page_name'];
                                        $title        = $row['page_title'];
                                        $slug         = $row['page_slug'];
                                        $description  = $row['page_description'];
                                        $status       = $row['status'];
                                    ?>
                                    <tr>
                                      <td><?php echo $sl++; ?></td>
                                      <td><?php echo $name;?></td>
                                      <td><?php echo $title;?></td>
                                      <td><?php echo $slug;?></td>
                                      <td><?php echo $description;?></td>
                                      <td>
                                        <?php 

                                            if($status == 0){
                                                echo "<a href='change-status.php?id=$id&&value=1&&table=pages' class='btn btn-danger'>Disable</a>";
                                            }elseif($status == 1){
                                                echo "<a href='change-status.php?id=$id&&value=0&&table=pages' class='btn btn-success'>Enable</a>";
                                            }
                                        ?>
                                      </td>
                                      <td>
                                        <a class="btn btn-success btn-sm d-block mb-2" href='<?php echo "edit-page.php?id=$id";?>'><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm d-block" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $id;?>">
                                          <i class="fa fa-trash-alt"></i>&nbsp;&nbsp;Delete
                                        </button></td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLongTitle">Delete Page</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <h5 class="text-center">If you want to delete page ?</h5>
                                              </div>
                                              <div class="modal-footer">
                                                <a href='<?php echo "delete-page.php?id=$id"?>' class="btn btn-danger">Yes</a>
                                                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php require_once ('include/footer.php'); ?>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once ('include/js.php');?>
    </body>
</html>