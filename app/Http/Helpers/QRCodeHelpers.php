<?php

/**
 * QR Code Generator Helper
 *
 * @author Mohamed Alansary
 */
namespace App\Http\Helpers;

use Webpatser\Uuid\Uuid;
use QrCode;
use File;
use App\User;

class QRCodeHelpers
{
    public static function generateQRCode($user_id)
    {
        $user = User::find($user_id);

        // Deleting previous qr code image if any
        if ($user->qr_code_image == 'login_qr_codes/'.request()->getHttpHost().'/qr_code_'.$user->id.'_'.$user->qr_code_string.'_'.str_replace(' ', '_', $user->name).'.png') {
            File::delete(public_path($user->qr_code_image));
            $user->qr_code_image = null;
            $user->qr_code_string = null;
            $user->save();
        }

        if(!File::exists('login_qr_codes/'.request()->getHttpHost())) {
            File::makeDirectory('login_qr_codes/'.request()->getHttpHost(), $mode = 0777, true, true);
        }

        $qr_code_string = (string) Uuid::generate(4);
        $qr_code_string = request()->getHttpHost().','.$qr_code_string;
        $qr_code_image_path = 'login_qr_codes/'.request()->getHttpHost().'/qr_code_'.$user->id.'_'.$qr_code_string.'_'.str_replace(' ', '_', $user->name).'.png';
        // $qr_code_image = base64_encode(QrCode::encoding('UTF-8')->format('png')->size(300)->backgroundColor(255, 255, 255)->merge('/public/assets/images/qr_code_logo.png', 0.5)->errorCorrection('H')->generate($qr_code_string, public_path($qr_code_image)));
        $qr_code_image = base64_encode(QrCode::encoding('UTF-8')->format('png')->size(300)->backgroundColor(255, 255, 255)->errorCorrection('H')->generate($qr_code_string, public_path($qr_code_image_path)));

        $user->qr_code_string = $qr_code_string;
        $user->qr_code_image = $qr_code_image_path;
        $user->save();
    }
}
