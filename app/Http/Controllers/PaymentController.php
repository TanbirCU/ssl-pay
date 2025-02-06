<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use DGvai\SSLCommerz\SSLCommerz;

class PaymentController extends Controller
{
    public function checkout($productId)
    {
        $postData = [
            'store_id' => env('SSLC_STORE_ID'),
            'store_passwd' => env('SSLC_STORE_PASSWORD'),
            'total_amount' => 100,
            'currency' => 'BDT',
            'tran_id' => uniqid(),
            'success_url' => route('payment.success'),
            'fail_url' => route('payment.fail'),
            'cancel_url' => route('payment.cancel'),
            'emi_option' => 0,
            'cus_name' => 'John Doe',
            'cus_email' => 'johndoe@example.com',
            'cus_add1' => 'Dhaka',
            'cus_city' => 'Dhaka',
            'cus_country' => 'Bangladesh',
            'cus_phone' => '017XXXXXXXX',
            'shipping_method' => 'NO',
            'product_name' => 'Sample Product',
            'product_category' => 'General',
            'product_profile' => 'general',
        ];

        $apiUrl = env('SSLC_SANDBOX_MODE') ? 
            'https://sandbox.sslcommerz.com/gwprocess/v4/api.php' : 
            'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $apiUrl);
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($code == 200 && !(curl_errno($handle))) {
            curl_close($handle);
            $sslcommerzResponse = json_decode($response, true);

            if (isset($sslcommerzResponse['GatewayPageURL']) && $sslcommerzResponse['GatewayPageURL'] != "") {
                return redirect()->to($sslcommerzResponse['GatewayPageURL']);
            } else {
                return back()->with('error', 'Payment gateway request failed!');
            }
        } else {
            curl_close($handle);
            return back()->with('error', 'Failed to connect to SSLCommerz!');
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Retrieve session data
        $postData = session()->get('payment_data');

        if (!$postData) {
            return "Session expired or payment data missing!";
        }

        // Validate payment using SSLCommerz API
        $validationUrl = "https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id={$request->val_id}&store_id=" . env('SSLC_STORE_ID') . "&store_passwd=" . env('SSLC_STORE_PASSWORD') . "&v=1&format=json";

        $response = file_get_contents($validationUrl);
        $validationResponse = json_decode($response, true);

        if ($validationResponse['status'] === 'VALID') {
            // Store payment data in the database
            Payment::create([
                'transaction_id' => $validationResponse['tran_id'],
                'amount' => $validationResponse['amount'],
                'currency' => $validationResponse['currency_type'],
                'status' => $validationResponse['status'],
                'customer_name' => $postData['cus_name'],
                'customer_email' => $postData['cus_email'],
            ]);

            return "Payment Successful! Transaction ID: " . $validationResponse['tran_id'];
        }

        return "Payment Validation Failed!";
    }

    public function paymentFail(Request $request)
    {
        return "Payment Failed! Please try again.";
    }

    public function paymentCancel(Request $request)
    {
        return "Payment Cancelled!";
    }
}

