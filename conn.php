<?php
/** 
 * PHP version 5
 * 
 * @catagory	Server and Databse Connection File
 * @package	IoT GateWay
 * @author	
 * @version	Release: 1.0
 * @since	March 23, 2017
 * @link	
 * @license
 * @copyright
 *
 * Connect to Specefied Databse 
 *
 * @show mysqli_connect_error message when it cann't connect
 * to specefied Database
 */

$con = mysqli_connect("localhost","root","root","telehealth"); #store query execution result to con variable

//------------------------------------------------------------
// mysqli_connect(ServerName,UserName,PassWord,DatabaseName)
// It Returns Object Which Represent The Connection To Server
//------------------------------------------------------------

if (!$con){ // IF CONNECTION IS NOT ESTABLISHED
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
