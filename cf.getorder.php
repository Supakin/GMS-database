<?php
  require_once('GMSdb/connect.inc.php');
  connect();
    $gpo_id = $_POST['gpo_id'];
    $ord_id = $_POST['ord_id'];
    $date = $_POST['date'];
    $p =  $_POST['product'];
    $pn = $_POST['productname'];
    $oa = $_POST['orderamount'];
    $ga = $_POST['gotamount'];
    $a = $_POST['getamount'];
    $product = array();
    $productname = array();
    $orderamount = array();
    $gotamount = array();
    $getamount = array();
    for($i=0;$i<count($p);$i++){
      if($a[$i]!=null && $a[$i]!=0){
        $product[] = $p[$i];
        $productname[] = $pn[$i];
        $orderamount[] = $oa[$i];
        $gotamount[] = $ga[$i];
        $getamount[] = $a[$i];
      }
    }

    $sql = "SELECT SEL_ID,SEL_NAME,ORD_DATE FROM ORDERS NATURAL JOIN SELLER WHERE ORD_ID = \"$ord_id\"";
    $sql_query = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_array($sql_query);

?>
<!DOCTYPE html>
<html>
<head>
<!-- Always force latest IE rendering engine -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<title> gms.garage-management-systems.com</title>
<!--CSS-bootstrap4-->
<link rel ="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!--CSS-myCSS-->
<link rel ="stylesheet" href="myCSS.css">

<!--JS-bootstrap4-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!--JS-myJS-->
<script type="text/javascript" src="myJS.js"></script>

<!--icon-->
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>

<!--font-Thai-->
<link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">

</head>
<body>
<div class="container">
  <div class="row justify-content-center align-content-center">
    <button type="button" class="btn btn-info btn-block mt-2 shadow-sm" onClick =" window.history.go(-1)">
      <i class='fas fa-pen-square' style='font-size:10px;color:white'></i>
      กลับไปแก้ไขข้อมูลการรับอะไหล่
    </button>
  </div>
  <form  action="insert.data.php" method="post" >
  <input type="hidden" name="action" value="addgetorder">
  <div class="row mt-3 mb-3 align-items-center">
    <div class="col-1">
      <i class="fas fa-pen-square" style='font-size:65px;color:black'></i>
    </div>
    <div class="col-11">
      <h3>รหัสการรับ : <?php echo $gpo_id ?></h3>
      <input type="hidden" name="gpo_id"  value="<?php echo $gpo_id?>">
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      รหัสใบนำเข้าอะไหล่
    </div>
    <div class="col-3">
      <?php echo $ord_id ?>
      <input type="hidden" name="ord_id"  value="<?php echo $ord_id?>">
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2">
      รหัสผู้ขาย
    </div>
    <div class="col-3">
      <?php  echo $row['SEL_ID'] ?>
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2">
      ชื่อผู้ขาย
    </div>
    <div class="col-3">
      <?php  echo $row['SEL_NAME'] ?>
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      กำหนดวันได้รับ :
    </div>
    <div class="col-3">
      <?php echo $row['ORD_DATE'] ?>
    </div>
  </div>
  <div class="row justify-content-end  m-1">
    <div class="col-2 ">
      วันที่ได้รับ :
    </div>
    <div class="col-3">
      <?php echo $date ?>
      <input type="hidden" name="date"  value="<?php echo $date?>">
    </div>
  </div>
  <br>
  <div class="row">
    <table class="table table-hover table-bordered">
      <thead class="thead-dark">
        <tr align="center">
          <th>รายการที่</th>
          <th>รหัสสินค้า</th>
          <th>ชื่อสินค้า</th>
          <th>จำนวนที่สั่ง</th>
          <th>รับแล้ว</th>
          <th>จำนวนที่กำลังรับ</th>
        </tr>
      </thead>

      <?php
        for($i=0;$i<count($product);$i++){
      ?>
          <tr>
            <td align="center">
              <?php echo $i+1; ?>
            </td>
            <td align="center">
              <?php echo $product[$i] ?>
              <input type="hidden" name="product[]" value="<?php echo $product[$i] ?>">
            </td>
            <td>
              <?php echo $productname[$i] ?>
            </td>
            <td align="center">
              <?php echo $orderamount[$i] ?>
            </td>
            <td align="center">
              <?php echo $gotamount[$i] ?>
            </td>
            <td align="center">
              <?php echo $getamount[$i] ?>
              <input type="hidden" name="getamount[]" value="<?php echo $getamount[$i] ?>">
            </td>
          </tr>
      <?php
      }
      ?>
      </table>
    </div>
    <div class="row justify-content-center text-red m-2">
      ** กรุณาตรวจสอบให้ข้อมูลให้ถูกต้องก่อนกดยืนยัน **
    </div>
    <div class="row justify-content-center">
      <button type="submit" name="save" class="btn btn-success btn-block shadow-sm">ยืนยัน</button>
    </div>
  </form>
  </div>
</body>
</html>
<?php
  disconnect();
?>
