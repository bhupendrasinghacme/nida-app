<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
require("zendesk/vendor/autoload.php");
use \Zendesk\API\HttpClient as ZendeskAPI;
include 'CurlController.php';

class UninstallController extends Controller
{

public function index(Request $request)
{
    $curlController = new CurlController();
    $shop = $_GET['shop'];
    $customer_email = 'nick@shopifygenius.com';
    // DB::update('update shopify_stores set pay_status = ? where store_url = ?',['pending',$shop]);
    $message = "App is uninstalled on this store:
	    Store URL : $shop
	    Email : $customer_email";
		$subdomain  = "chaostheory";
		$username   = "nida@chaostheoryhq.com";
		$token      = "vrS85uJdesBAxRAj04z4j89N9IdiH5u4G4FCz9pe";
		//$attachment = getcwd().'/sample.jpg';
		$client = new ZendeskAPI($subdomain);
		$client->setAuth('basic', ['username' => $username, 'token' => $token]);
		try {
		// Upload file
		// $attachment = $client->attachments()->upload([
		//     'file' => $attachment,
		//     'type' => 'image/jpg',
		//     'name' => 'sample.jpg'
		// ]);

		// Create a new ticket with attachment
		$newTicket = $client->tickets()->create([
		    'type' => 'uninstalled',
		    'tags'  => array('support','uninstall'),
		    'subject'  => 'New uninstall request',
		    'comment'  => array(
		        'body' => $message
		        //'uploads' => [$attachment->upload->token]
		    ),
		    'requester' => array(
		        'locale_id' => '1',
		        'name' => $customer_email,
		        'email' => $customer_email,
		    ),
		    'priority' => 'normal',
		]);
		// Show result
		// echo "<pre>";
		// print_r($newTicket);
		// echo "</pre>";
		$statusMsg = "Setup Requested";
		} catch (\Zendesk\API\Exceptions\ApiResponseException $e) {
		echo $e->getMessage().'</br>';
		}	
   
}
}
?>