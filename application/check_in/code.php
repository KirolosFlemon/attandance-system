<?php
//// include config script ////
include('../../includes/config.php');
//// end of config script ////

//// Include Language ////
include('../../includes/languages/language_switch.php');

if ($_SESSION['language'] == 'AR') {
    include('../../includes/languages/arabic.php');
} else {
    include('../../includes/languages/english.php');
}
//// End Language ////

?>
<?php
$date=date("Y-m-d H:i:s");
$title='Checked-in';

$user_id = $_SESSION['user_id'];
$date1 = date("Y-m-d");

$stmt = mysqli_query($website, "SELECT * FROM checked WHERE check_date='$date1' AND user_id='$user_id' ");
$row = mysqli_fetch_assoc($stmt);

if (isset($row['check_in'])&&!empty($row['check_in'])) {
    echo 'test';
} else {
?>

<div class="col-lg-12" >
    <img id='barcode' style="display: block;margin: auto"
         src="https://api.qrserver.com/v1/create-qr-code/?data=Checked-in=<?php echo $date?>&amp;size=500x500"
         alt=""
         title="<?php echo $title; ?>"
         width="300"
         height="300">
</div>
    <?php
    }
        ?>