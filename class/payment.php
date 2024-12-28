<?php


class  payment
{
    private $api_key;
    private $callback;


    public function __construct($api_key, $callback)
    {
        $this->api_key = $api_key;
        $this->callback = $callback;

    }


    public function request($amount)
    {
        $url = 'https://gateway.zibal.ir/v1/request';
        $data = [
            "merchant" => "$this->api_key",
            "amount" => "$amount",
            "callbackUrl" => "$this->callback",
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            echo "HTTP Status Code: " . $httpCode . "
";


            // پردازش پاسخ JSON
            $responseData = json_decode($response, true);
            if ($responseData && isset($responseData['result'])) {

                if ($responseData['result'] == 100) {
                    if ($responseData['trackId']) {
                        header("location:https://gateway.zibal.ir/start/" . $responseData['trackId']);

                    }
                } else {
                    echo 'خطایی رخ داد';
                }

            } else {
                echo "Error decoding JSON response or 'result' key not found.
";
            }
        }

        curl_close($ch);


    }


    public function verify($trackid)
    {
        $url = 'https://gateway.zibal.ir/v1/verify';
        $data = [
            "merchant" => "$this->api_key",
            "trackId" => "$trackid",
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);

        } else {

            // پردازش پاسخ JSON
            $responseData = json_decode($response, true);
            if ($responseData && isset($responseData['result'])) {

                if ($responseData['result'] == 100) {
                    if ($responseData['message'] == 'success') {
                        return true;
                    }
                } elseif ($responseData['result'] == 202) {
                    return false;
                } elseif ($responseData['result'] = 201) {

                    header("location: ./index.php");

                }


            } else {
                echo "Error decoding JSON response or 'result' key not found.
";
            }
        }

        curl_close($ch);


    }


}

$payment = new payment('zibal', 'http://localhost/php/Link-shortener/verify.php');

if (isset($_POST['submitvip'])) {
    $plan = $_POST['vip'];

    switch ($plan) {
        case 7:
            $amount = 200000;

            $payment->request($amount);

            break;
        case 15:
            $amount = 300000;

            $payment->request($amount);

            break;

        case 30:
            $amount = 600000;

            $payment->request($amount);

            break;
    }
}