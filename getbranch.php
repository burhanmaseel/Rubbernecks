<html>

<?php
/**
 * Created by PhpStorm.
 * User: burhan
 * Date: 6/11/2018
 * Time: 3:32 PM
 */

include 'config.php';

$sql="SELECT clients.c_id,clients.c_name,branch.b_id, branch.b_name FROM clients,branch,branch_surverys WHERE clients.c_id=".$_POST['client_id']." AND clients.c_id=branch_surverys.c_id AND branch_surverys.b_id=branch.b_id GROUP BY branch.b_name";
$branches = $mysqli->query($sql);
?>

<option value="">Select Branch</option>
<?php
while ($rs=$branches->fetch_assoc()){

    $bname=$rs['b_name'];
    $bid=$rs['b_id'];
    ?>
    <option value="<?php echo $bid; ?>"><?php echo $bname; ?></option>

<?php } ?>
</html>
