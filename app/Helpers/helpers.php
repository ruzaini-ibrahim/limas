<?php

function validator_message($validator)
{
	$validateMessage = "<b class='font-weight-700 mt-2'>Please check your form!</b>";
        if($validator->fails()){
            $error = $validator->messages()->toArray();
            foreach ($error as $messages) {
                foreach ($messages as $message) {
                    $validateMessage .= "<li>" . $message . "</li>";
                }
            }
            return json_encode(['error' => true, 'message' => $validateMessage]);
        }else{
        	return json_encode(['error' => false, 'message' => "No error found!"]);
        }
}

function bookType($type)
{
    switch ($type) {
        case "0":
        $response =  "Non-Fiction";
        break;
        case "1":
        $response = "Fiction";
        break;
        default:
        $response = "Fiction";
    }

        return $response;
}