<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'google2fa_secret'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function order()
    {
        return $this->hasOne(Order::class)->where('status', 'Order Created')->first();
    }

    public function cart()
    {
        return $this->hasOne(Order::class)->where('status', 'Order Created')->first();
    }

    public function loginSecurity()
    {
        return $this->hasOne(LoginSecurity::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function generateCode()
    {


        $otp = new Otp();
        $otp->phone = auth()->user()->profile->phone;
        $otp->code = rand(100000, 999999);
        $otp->user_id = auth()->user()->id;
        $otp->save();

        $receiverNumber = auth()->user()->profile->phone;
        $message = "2FA login code is " . $otp->code;

        // try {

        //     $config = Configuration::getDefaultConfiguration();
        //     $config->setApiKey('Authorization', env('SMS_GATEWAY_TOKEN'));
        //     $apiClient = new ApiClient($config);
        //     $messageClient = new MessageApi($apiClient);

        //     // Sending a SMS Message
        //     $sendMessageRequest1 = new SendMessageRequest([
        //         'phoneNumber' => (int)auth()->user()->profile->phone,
        //         'message' => 'Tolong info calfin Your Token Code is ' . $otp->code,
        //         'deviceId' => 127888
        //     ]);

        //     $sendMessages = $messageClient->sendMessages([
        //         $sendMessageRequest1
        //     ]);
        // } catch (Exception $e) {
        //     info("Error: " . $e->getMessage());
        // }
    }
}
