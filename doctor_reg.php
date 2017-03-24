<?php
/** 
 * PHP version 5
 * 
 * @catagory    Doctor Registration
 * @package     IoT GateWay
 * @author      
 * @version     Release: 1.0
 * @since       March 23, 2017
 * @link        
 * @license
 * @copyright
 *
 * It requires connection to server at prior,
 * Then it REQUEST for number of data (12), verifies if data is empty or not
 * if empty then @show incomplete data message
 * else insert all that data to databse using connection string
 * into @table doctor_reg
 * 
 */

require "conn.php";  // File having connection to server-databse 

//================================================================
// CHECK IF ANY OF THE DATA FIELD IS LEFT EMPTY
//================================================================

//----------------------------------------------------------------
// isset(@var) Returns True if Varible Has Value
// $_REQUEST[FiledName] To Collect Data From Submitted Form 
//----------------------------------------------------------------

if(isset($_REQUEST['aadhar_id'])&&
   isset($_REQUEST['password'])&&
   isset($_REQUEST['first_name'])&&
   isset($_REQUEST['last_name'])&&
   isset($_REQUEST['email_id'])&&
   isset($_REQUEST['mobile_no'])&&
   isset($_REQUEST['hospital'])&&
   isset($_REQUEST['pincode'])&&
   isset($_REQUEST['dob'])&&
   isset($_REQUEST['gender'])&&
   isset($_REQUEST['blood_group'])&&
   isset($_REQUEST['telephone'])) {

//--------------------------------------------------
// Assign All The Data Into Different Varibales 
//--------------------------------------------------

	$aadhar_id= $_REQUEST['aadhar_id'];

//--------------------------------------------------
// md5 function to encrypt password 
// md5(PASSWORD) will return 32 bit hash value
//--------------------------------------------------

	$password=md5($_REQUEST['password']);
	$first_name=$_REQUEST['first_name'];
	$last_name=$_REQUEST['last_name'];
	$email_id=$_REQUEST['email_id'];
	$mobile_no=$_REQUEST['mobile_no'];
	$telephone=$_REQUEST['telephone'];
	$hospital=$_REQUEST['hospital'];
	$pincode=$_REQUEST['pincode'];
	$dob=$_REQUEST['dob'];

//---------------------------------------------------
// Calculate Age Based On Entered Date of Birth 
//---------------------------------------------------

	$age=floor((time()-strtotime($dob))/31556926);
	$gender=$_REQUEST['gender'];
	$blood_group=$_REQUEST['blood_group'];

//---------------------------------------------------
// Using Connection String Execute Insert Query
//---------------------------------------------------
			
	if(mysqli_query($con,"INSERT INTO `doctor_reg`(`aadhar_id`, `first_name`, `last_name`, `password`, `email_id`, `mobile_no`, `dob`, `age`, `gender`, `blood_group`, `hospital`, `telephone`, `pincode`, `status`) VALUES ('$aadhar_id','$first_name','$last_name','$password','$email_id','$mobile_no','$dob','$age','$gender','$blood_group','$hospital','$telephone','$pincode','0')")) {		   echo "Registration Successful";  // When Query Is Successfully Executed	
	}		
        else {
		echo "ERROR: Registration unsuccessful!\n\tTRY AGAIN LATER";  // When Insertion Operation cann't be performed
        }
}
else {
	echo "ERROR: Incomplete Data";    // When Data Sent To perform Insert opertaion is not proper
}	

mysqli_close($con);  // Close Connection After Execution Of Query

?>
