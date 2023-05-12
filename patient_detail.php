<?php
include './config/connection.php';
include './common_service/common_functions.php';
$patients = getPatients($con);
$message = '';
if (isset($_POST['save_Patient'])) {
  
    $hiddenId = $_POST['hidden_id'];

    $patientName = trim($_POST['patient_name']);
    $address = trim($_POST['address']);
    $cnic = trim($_POST['cnic']);
    
    $dateBirth = trim($_POST['date_of_birth']);
    $dateArr = explode("/", $dateBirth);

    $dateBirth = $dateArr[2].'-'.$dateArr[0].'-'.$dateArr[1];

    $phoneNumber = trim($_POST['phone_number']);

    $patientName = ucwords(strtolower($patientName));
    $address = ucwords(strtolower($address));

    $gender = $_POST['gender'];
    if ($patientName != '' && $address != '' && 
        $cnic != '' && $dateBirth != '' && $phoneNumber != '' && $gender != '') {
          $query = "update `patients` 
        set `patient_name` = '$patientName', 
        `address` = '$address', 
        `cnic` = '$cnic', 
        `date_of_birth` = '$dateBirth', 
        `phone_number` = '$phoneNumber', 
        `gender` = '$gender' 
        where `id` = $hiddenId;";
    try {

  $con->beginTransaction();

  $stmtPatient = $con->prepare($query);
  $stmtPatient->execute();

  $con->commit();

  $message = 'Patient updated successfully.';

} catch(PDOException $ex) {
  $con->rollback();

  echo $ex->getMessage();
  echo $ex->getTraceAsString();
  exit;
}
}
  header("Location:congratulation.php?goto_page=patients.php&message=$message");
  exit;
}



try {
$id = $_GET['id'];
$query = "SELECT `id`, `patient_name`, `diachi`, 
`cmnd`, date_format(`date_of_birth`, '%m/%d/%Y') as `date_of_birth`,  `phone_number`, `gender` ,
`visit_date`, `weight`, `patient_diagnostic_id`, `chandoan`, `lamsang`, `gan`,
								  `duongmat`, `ongmatchu`, `tuimat`, `thantrai`, `thanphai`, `tuy`, `lach`,
								  `bangquang`, `tuicung`, `tucung`, `buongtrungtrai`, `buongtrungphai`, `ghinhankhac`, `hinhanhsieuam`,
								  `ketluan`
FROM `patient_examen` where `id` = $id;";

  $stmtPatient1 = $con->prepare($query);
  $stmtPatient1->execute();
  $row = $stmtPatient1->fetch(PDO::FETCH_ASSOC);

  $gender = $row['gender'];
  $dob = $row['date_of_birth']; 
} catch(PDOException $ex) {

  echo $ex->getMessage();
  echo $ex->getTraceAsString();
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include './config/site_css_links.php';?>

 <?php include './config/data_tables_css.php';?>

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <title>Update Pateint Details - Clinic's Patient Management System in PHP</title>

</head>
<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
 <?php include './config/header.php';
include './config/sidebar.php';?>  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Patients</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
     <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
          <h3 class="card-title">Chi tiết thăm khám</h3>
          
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
        <div class="card-body">
          <form method="post">
            <input type="hidden" name="hidden_id" 
            value="<?php echo $row['id'];?>">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
              <label>Tên bệnh nhân</label>
              <input type="text" id="patient_name" name="patient_name" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['patient_name'];?>" />
              </div>
              <br>
              <br>
              <br>
              <!-- $Address -->
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Địa chỉ</label> 
                <input type="text" id="diachi" name="diachi" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['diachi'];?>" />
              </div>
              <!-- $CNIC -->
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>CMND</label>
                <input type="text" id="cmnd" name="cmnd" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['cmnd'];?>" />
              </div>
              <!-- $date_of_birth -->
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <div class="form-group">
                  <label>Ngày sinh</label>
                    <div class="input-group date" 
                    id="date_of_birth" 
                    data-target-input="nearest">
                        <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-target="#date_of_birth" name="date_of_birth" 
                        value="<?php echo $dob;?>" />
                        <div class="input-group-append" 
                        data-target="#date_of_birth" 
                        data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- $PhoneNumber -->
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Số điện thoại</label>
                <input type="text" id="phone_number" name="phone_number" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['phone_number'];?>" />
              </div>
              <!-- $gender -->
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Giới tính</label>
                  <select class="form-control form-control-sm rounded-0" id="gender" 
                    name="gender">
                  <?php echo getGender($gender);?>
                  </select>
              </div>
              <!-- FILL THE EXAMEN-->
              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">3. Chẩn đoán:</label>
                <input id="chandoan" required="required" name="chandoan" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" 
                value="<?php echo $row['chandoan'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">4. Lâm sàng:</label>
                <input id="lamsang" required="required" name="lamsang" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" 
                value="<?php echo $row['lamsang'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">5. Gan:</label>
                <input id="gan" required="required" name="gan" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;"
                value="<?php echo $row['gan'];?>" />
              </div>


              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">6. Đường mật:</label>
                <input id="duongmat" required="required" name="duongmat" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" 
                value="<?php echo $row['duongmat'];?>" />
              </div>


              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">7. Ống mật chủ:</label>
                <input id="ongmatchu" required="required" name="ongmatchu" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" 
                value="<?php echo $row['ongmatchu'];?>" />
              </div>


              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">8. Túi mật:</label>
                <input id="tuimat" required="required" name="tuimat" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" 
                value="<?php echo $row['tuimat'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">9. Thận trái:</label>
                <input id="thantrai" required="required" name="thantrai" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;"
                value="<?php echo $row['thantrai'];?>" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">Thận phải:</label>
                <input id="thanphai" required="required" name="thanphai" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" 
                value="<?php echo $row['thanphai'];?>" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">10. Tụy:</label>
                <input id="tuy" required="required" name="tuy" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" 
                value="<?php echo $row['tuy'];?>" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">11. Lách:</label>
                <input id="lach" required="required" name="lach" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" 
                value="<?php echo $row['lach'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">12. Bàng quang:</label>
                <input id="bangquang" required="required" name="bangquang" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;"
                value="<?php echo $row['bangquang'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">13. Túi cùng:</label>
                <input id="tuicung" required="required" name="tuicung" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;"
                value="<?php echo $row['tuicung'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">14. Tử cung:</label>
                <input id="tucung" required="required" name="tucung" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;"
                value="<?php echo $row['tucung'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">15. Buồng trứng trái:</label>
                <input id="buongtrungtrai" required="required" name="buongtrungtrai" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;"
                value="<?php echo $row['buongtrungtrai'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">Buồng trứng phải:</label>
                <input id="buongtrungphai" required="required" name="buongtrungphai" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;"
                value="<?php echo $row['buongtrungphai'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">Ghi nhận khác:</label>
                <input id="ghinhankhac" required="required" name="ghinhankhac" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;"
                value="<?php echo $row['ghinhankhac'];?>" />
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">HÌNH ẢNH SIÊU ÂM:</label>
                <img src="anhsieuam/<?php echo $row['hinhanhsieuam'];?>">
              </div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">KẾT LUẬN:</label>
                <input id="ketluan" required="required" name="ketluan" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;"
                value="<?php echo $row['ketluan'];?>" />
              </div>
            </div>

              <div class="row">
                <div class="col-lg-11 col-md-10 col-sm-10 xs-hidden">&nbsp;</div>
          </form>
        </div>
        
      </div>
      
    </section>
     <br/>
     <br/>
     <br/>
  </div>
  <!-- /.content-wrapper -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php 
 include './config/footer.php';

  $message = '';
  if(isset($_GET['message'])) {
    $message = $_GET['message'];
  }
?>  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include './config/site_js_links.php'; ?>
<?php include './config/data_tables_js.php'; ?>


<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
  showMenuSelected("#mnu_patients", "#mi_patients");

  var message = '<?php echo $message;?>';

  if(message !== '') {
    showCustomMessage(message);
  }
  $('#date_of_birth').datetimepicker({
        format: 'L'
    });
      
    
   $(function () {
    $("#all_patients").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#all_patients_wrapper .col-md-6:eq(0)');
    
  });


$(document).ready(function() {
  $("#search").click(function() {
    var patientId = $("#patient").val();

    if(patientId !== '') {

      $.ajax({
        url: "ajax/get_patient_history.php",
        type: 'GET', 
        data: {
          'patient_id': patientId
        },
        cache:false,
        async:false,
        success: function (data, status, xhr) {
            $("#history_data").html(data);
        },
        error: function (jqXhr, textStatus, errorMessage) {
          showCustomMessage(errorMessage);
        }
      });

    }

});

//event driven programming

});
</script>
<script>
function previewImage() {
  var preview = document.getElementById('preview');
  var file    = document.getElementById('hinhanhsieuam').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
    preview.style.display = 'block';
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = '';
    preview.style.display = 'none';
  }
}
</script>
</body>
</html>