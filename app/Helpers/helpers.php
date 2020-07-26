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

function calcFine($return_date, $due_date)
{
    $price_params = 0.5;
    $total = date_diff(date_create($due_date), date_create($return_date))->days * $price_params;
    return number_format($total, 2);
}

function dateToday()
{
    $date = date('d-m-Y');
    return $date;
}

function dateFormatYMD($date)
{
    $dateFormated = date("Y-m-d", strtotime($date));
    return $dateFormated;
}

function dateFormatDMY($date)
{
    $dateFormated = date("d-m-Y", strtotime($date));
    return $dateFormated;
}