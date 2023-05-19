<?php
include './config/connection.php';
include './common_service/common_functions.php';

// This function to save a new patient examen
$message = '';
if (isset($_POST['save_Patient'])) {

    $patientName = trim($_POST['patient_name']);
    $patientName = ucwords(strtolower($patientName));
    $diachi = trim($_POST['diachi']);
    $diachi = ucwords(strtolower($diachi));
    $cmnd = trim($_POST['cmnd']);
    $tuoi = trim($_POST['tuoi']);
    
    $visit_date = trim($_POST['visit_date']);
    $dateArr = explode("/", $visit_date);
    $visit_date = $dateArr[2].'-'.$dateArr[0].'-'.$dateArr[1];
  
    $phoneNumber = trim($_POST['phone_number']);
    $gender = $_POST['gender'];
    $chandoan = $_POST['chandoan'];
    $lamsang = $_POST['lamsang'];
    $gan = $_POST['gan'];
    $duongmat = $_POST['duongmat'];
    $ongmatchu = $_POST['ongmatchu'];
    $tuimat = $_POST['tuimat'];
    $thantrai = $_POST['thantrai'];
    $thanphai = $_POST['thanphai'];
    $tuy = $_POST['tuy'];
    $lach = $_POST['lach'];
    $bangquang = $_POST['bangquang'];
    $tuicung = $_POST['tuicung'];
    $tucung = $_POST['tucung'];
    $buongtrungtrai = $_POST['buongtrungtrai'];
    $buongtrungphai = $_POST['buongtrungphai'];
    $ghinhankhac = $_POST['ghinhankhac'];
    $ketluan = $_POST['ketluan'];


    // Store image data into a local folder
    $baseName = basename($_FILES["hinhanhsieuam"]["name"]);
    $targetFile =  time().$baseName;
    $status = move_uploaded_file($_FILES["hinhanhsieuam"]["tmp_name"], 'anhsieuam/'.$targetFile);
    $hinhanhsieuam = $targetFile;
    try {

      $con->beginTransaction();

      $query = "INSERT INTO `patient_examen`(`patient_name`, 
      `diachi`, `cmnd`,`tuoi`,  `visit_date`,`phone_number`, `gender`,
      `chandoan`, `lamsang`, `gan`, `duongmat`, `ongmatchu`,
      `tuimat`, `thantrai`, `thanphai`, `tuy`, `lach`,
      `bangquang`, `tuicung`, `tucung`, `buongtrungtrai`, `buongtrungphai`,
      `ghinhankhac`, `hinhanhsieuam`, `ketluan`)
        VALUES('$patientName', '$diachi', '$cmnd','$tuoi',  '$visit_date','$phoneNumber', '$gender',
              '$chandoan','$lamsang', '$gan', '$duongmat', '$ongmatchu','$tuimat', '$thantrai',
              '$thanphai','$tuy', '$lach', '$bangquang', '$tuicung','$tucung', '$buongtrungtrai',
              '$buongtrungphai','$ghinhankhac', '$hinhanhsieuam', '$ketluan');";

      $stmtPatient = $con->prepare($query);
      $stmtPatient->execute();

      $con->commit();

      $message = 'Đã thêm bệnh nhân vào danh sách';

    } catch(PDOException $ex) {
      $con->rollback();

      echo $ex->getMessage();
      echo $ex->getTraceAsString();
      exit;
    }
  header("Location:congratulation.php?goto_page=list_patients.php&message=$message");
  exit;
}


// This function to load all patients from patient_examen on the database 
try {
$query = "SELECT `id`, `patient_name`, `diachi`, 
`cmnd`, date_format(`visit_date`, '%d %b %Y') as `visit_date`, 
`phone_number`, `gender` 
FROM `patient_examen` order by `patient_name` asc;";

  $stmtPatient1 = $con->prepare($query);
  $stmtPatient1->execute();

} catch(PDOException $ex) {
  echo $ex->getMessage();
  echo $ex->getTraceAsString();
  exit;
}

$list_patients = getPatientHistory($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include './config/site_css_links.php';?>

 <?php include './config/data_tables_css.php';?>

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <title>Patients - Clinic's Patient Management System in PHP</title>

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
            <h1>Bệnh nhân</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
     <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
          <h3 class="card-title">Thêm bệnh nhân mới</h3>
          
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>

        <div class="card-body">
          <form method="post" enctype="multipart/form-data" >
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Tên bệnh nhân</label>
                <input type="text" id="patient_name" name="patient" list="patientList" required="required"
                  class="form-control form-control-sm rounded-0"/>
                  <datalist id="patientList">
                    <?php echo $list_patients; ?>
                  </datalist>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Địa chỉ</label> 
                <input type="text" id="diachi" name="diachi" 
                class="form-control form-control-sm rounded-0"/>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>CMND</label>
                <input type="text" id="cmnd" name="cmnd" 
                class="form-control form-control-sm rounded-0"/>
              </div>
              
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Tuổi</label>
                <input type="text" id="tuoi" name="tuoi" 
                class="form-control form-control-sm rounded-0"/>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <div class="form-group">
                  <label>Ngày khám</label>
                    <div class="input-group date" 
                    id="visit_date" 
                    data-target-input="nearest">
                        <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-target="#visit_date" 
                        name="visit_date" data-toggle="datetimepicker" autocomplete="off" />
                        <div class="input-group-append" 
                        data-target="#visit_date" 
                        data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Số điện thoại</label>
                <input type="text" id="phone_number" name="phone_number"
                class="form-control form-control-sm rounded-0"/>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
              <label>Giới tính </label>
                <select class="form-control form-control-sm rounded-0" id="gender" 
                name="gender">
                  <?php echo getGender();?>
                </select>
              </div>
              <div class="clearfix">&nbsp;</div>


              <!-- FILL THE FORM FROM HERE -->
              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">3. Chẩn đoán:</label>
                <input id="chandoan"  name="chandoan" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">4. Lâm sàng:</label>
                <input id="lamsang"  name="lamsang" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">5. Gan:</label>
                <input id="gan"name="gan" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">6. Đường mật:</label>
                <input id="duongmat"  name="duongmat" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">7. Ống mật chủ:</label>
                <input id="ongmatchu"  name="ongmatchu" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">8. Túi mật:</label>
                <input id="tuimat"  name="tuimat" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">9. Thận trái:</label>
                <input id="thantrai"  name="thantrai" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">Thận phải:</label>
                <input id="thanphai"  name="thanphai" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">10. Tụy:</label>
                <input id="tuy" name="tuy" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">11. Lách:</label>
                <input id="lach" name="lach" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">12. Bàng quang:</label>
                <input id="bangquang" name="bangquang" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">13. Túi cùng:</label>
                <input id="tuicung" name="tuicung" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">14. Tử cung:</label>
                <input id="tucung" name="tucung" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">15. Buồng trứng trái:</label>
                <input id="buongtrungtrai" name="buongtrungtrai" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">Buồng trứng phải:</label>
                <input id="buongtrungphai"  name="buongtrungphai" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">Ghi nhận khác:</label>
                <input id="ghinhankhac"  name="ghinhankhac" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">HÌNH ẢNH SIÊU ÂM:</label>
                <input id="hinhanhsieuam" type="file" name="hinhanhsieuam" accept="image/*" 
                class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" onchange="previewImage();" />
                <br />
                <img id="preview" src="#" alt="Preview Image" style="max-width: 400px; margin-top: 10px; display: none;" />
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <label style="display: inline-block; margin-right: 10px;">KẾT LUẬN:</label>
                <input id="ketluan"  name="ketluan" class="form-control form-control-sm rounded-0" style="display: inline-block; width: 70%;" />
              </div>
              <div class="clearfix">&nbsp;</div>
            </div>

              <div class="row">
                <div class="col-lg-11 col-md-10 col-sm-10 xs-hidden">&nbsp;</div>

              <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                <button type="submit" id="save_Patient" 
                name="save_Patient" class="btn btn-primary btn-sm btn-flat btn-block">Lưu</button>
              </div>
            </div>
          </form>
        </div>
        
      </div>
      
    </section>

     <br/>
     <br/>
     <br/>

    <section class="content">
      <!-- Default box -->
      <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
          <h3 class="card-title">Danh sách bệnh nhân</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <div class="row table-responsive">
              <table id="all_patients" 
              class="table table-striped dataTable table-bordered dtr-inline" 
               role="grid" aria-describedby="all_patients_info">
              
                <thead>
                  <tr>
                    <th>Stt</th>
                    <th>Tên bệnh nhân</th>
                    <th>Địa chỉ</th>
                    <th>CMND</th>
                    <th>Ngày khám</th>
                    <th>Số điện thoại</th>
                    <th>Giới tính</th>
                    <th>Chi tiết</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                    $count = 0;
                    while($row =$stmtPatient1->fetch(PDO::FETCH_ASSOC)){
                      $count++;
                    ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $row['patient_name'];?></td>
                      <td><?php echo $row['diachi'];?></td>
                      <td><?php echo $row['cmnd'];?></td>
                      <td><?php echo $row['visit_date'];?></td>
                      <td><?php echo $row['phone_number'];?></td>
                      <td><?php echo $row['gender'];?></td>
                      <td>
                        <a href="patient_detail.php?id=<?php echo $row['id'];?>" class = "btn btn-primary btn-sm btn-flat">
                        <i class="fa fa-edit"></i>
                        </a>
                      </td>
                    
                    </tr>
                  <?php
                }?>
                </tbody>
              </table>
            </div>
          </div>
        <!-- /.card-footer-->
       </div>
      <!-- /.card -->
     </section>
    </div>
      <!-- /.content -->
    
    <!-- /.content-wrapper -->
<?php 
 include './config/footer.php';

  $message = '';
  if(isset($_GET['message'])) {
    $message = $_GET['message'];
  }
?>  
  <!-- /.control-sidebar -->


<?php include './config/site_js_links.php'; ?>
<?php include './config/data_tables_js.php'; ?>


<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
  showMenuSelected("#mnu_patients", "#mi_add_patient");

  var message = '<?php echo $message;?>';

  if(message !== '') {
    showCustomMessage(message);
  }
  $('#visit_date').datetimepicker({
        format: 'L'
    });
      
    
   $(function () {
    $("#all_patients").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#all_patients_wrapper .col-md-6:eq(0)');
    
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

<script>
  var patientInput = document.getElementById("patient_name");
  var patientList = document.getElementById("patientList");
  var diachiInput = document.getElementById("diachi");
  var cmndInput = document.getElementById("cmnd");
  var genderInput = document.getElementById("gender");
  var phone_numberInput = document.getElementById("phone_number");
  var tuoiInput = document.getElementById("tuoi");

  var options = Array.from(patientList.options).map(function(option) {
    return option.value.toLowerCase(); // Get the lowercase value instead of textContent
  });

  patientInput.addEventListener("input", function() {
    var enteredText = patientInput.value.toLowerCase();
    var matchIndex = options.findIndex(function(option) {
      return option.includes(enteredText);
    });

    if (matchIndex !== -1) {
      var selectedOption = patientList.options[matchIndex];
      selectedOption.selected = true; // Select the matching option
      var diachiValue = selectedOption.getAttribute("diachi");
      diachiInput.value = diachiValue;
      var cmndValue = selectedOption.getAttribute("cmnd");
      cmndInput.value = cmndValue;
      var genderValue = selectedOption.getAttribute("gender");
      genderInput.value = genderValue;
      var phone_numberValue = selectedOption.getAttribute("phone_number");
      phone_numberInput.value = phone_numberValue;
      var tuoiValue = selectedOption.getAttribute("tuoi");
      tuoiInput.value = tuoiValue;
    } else {
      diachiInput.value = "none";
    }
  });
</script>
</body>
</html>