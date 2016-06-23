<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use MongoDB\Client;
use App\Mongo;
use App\MongoUser;
use Input;

class IntroController extends Controller
{
 	public function index(Mongo $mongo)
 	{
 		$collection = $mongo->getCollection('users');
		$collection->insertMany(array(array("first_name" => "John", "last_name" => "Rivers", "email" => "john@test.com"), array("first_name" => "Michelle", "last_name" => "Rivers", "email" => "michelle@test.com")));
		echo 'inserted';
/*		foreach($result as $item){
			echo $item['first_name'].' '.$item['last_name'];
		}*/
		
 	}

 	public function test(){
 		return view('test');
 	}

 	public function processemail(){

 		$name = Input::get('name');
 		$email = Input::get('email');
 		$message = strip_tags(Input::get('message'));
 		$errors = array();
 		$invalid = false;
 		if(!preg_match('/^[a-zA-Z \']*$/', $name) || (strlen($name) == 0)){
 			$errors['name'] = "Invalid name";
 			$invalid = true;
 		}

 		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 			$errors['email'] = 'Invalid email';
 			$invalid = true;
 		}

 		if(trim($message) == ''){
 			$errors['message'] = 'Enter message';
 			$invalid = true;
 		}


 		if($invalid){
	 		$arr = array(
	 				'msg' => 'fail',
	 				'errors' => $errors
	 			);
 		}else{

 			//send email
			// multiple recipients
			$to  = 'rkang.sendme@gmail.com';

			// subject
			$subject = 'Client Contact From Analytic Machine';

			// message
			$content = '
			<html>
			<head>
			  <title>'.$subject.'</title>
			</head>
			<body>
			  <p>Your client has contacted! Please see below.</p>
			  <table cellpadding="10" cellspacing="0" border="0">
			    <tr>
			      <td>Name: </td><td>'.$name.'</td>
			    </tr>
			    <tr>
			      <td colspan=2>Message: </td>
			    </tr>
			    <tr>
			      <td>'.$message.'</td>
			    </tr>
			  </table>
			</body>
			</html>
			';

			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Additional headers
			$headers .= 'From: Analytic Machine' . "\r\n";
			$headers .= 'Cc: ' . "\r\n";
			$headers .= 'Bcc: ' . "\r\n";

			// Mail it
			mail($to, $subject, $content, $headers);

	 		$arr = array(
	 				'msg' => 'success'
	 			);
 		}

 		return json_encode($arr);

 	}

}
