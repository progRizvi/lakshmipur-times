<?php

namespace Modules\GlobalSetting\database\seeders;

use Illuminate\Database\Seeder;
use Modules\GlobalSetting\app\Models\Setting;

class GlobalSettingInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();

        $setting_data = [
            'app_name' => 'Lakshmipur Times',
            'editor' => 'Lakshmipur Times',
            'address' => 'বাগবাড়ি, লক্ষ্মীপুর সদর, লক্ষ্মীপুর - ৩৭০০',
            'version' => '1.00',
            'email' => 'lakshmipurtimes24@gmail.com',
            'logo' => 'uploads/website-images/logo.png',
            'timezone' => 'Asia/Dhaka',
            'date_format' => 'Y-m-d',
            'time_format' => 'h:i A',
            'favicon' => 'uploads/website-images/favicon.png',
            'cookie_status' => 'active',
            'border' => 'normal',
            'corners' => 'thin',
            'background_color' => '#184dec',
            'text_color' => '#fafafa',
            'border_color' => '#0a58d6',
            'btn_bg_color' => '#fffceb',
            'btn_text_color' => '#222758',
            'link_text' => 'More Info',
            'btn_text' => 'Yes',
            'message' => 'This website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only upon approval.',
            'copyright_text' => '© 2024, Lakshmipur Times. All Rights Reserved.',
            'recaptcha_site_key' => 'recaptcha_site_key',
            'recaptcha_secret_key' => 'recaptcha_secret_key',
            'recaptcha_status' => 'inactive',
            'tawk_status' => 'inactive',
            'tawk_chat_link' => 'tawk_chat_link',
            'googel_tag_status' => 'inactive',
            'googel_tag_id' => 'google_tag_id',
            'google_analytic_status' => 'active',
            'google_analytic_id' => 'google_analytic_id',
            'pixel_status' => 'inactive',
            'pixel_app_id' => 'pixel_app_id',
            'google_login_status' => 'inactive',
            'gmail_client_id' => 'google_client_id',
            'gmail_secret_id' => 'google_secret_id',
            'default_avatar' => 'uploads/website-images/default-avatar.png',
            'breadcrumb_image' => 'uploads/website-images/breadcrumb-image.jpg',
            'mail_host' => 'sandbox.smtp.mailtrap.io',
            'mail_sender_email' => 'sender@gmail.com',
            'mail_username' => 'mail_username',
            'mail_password' => 'mail_password',
            'mail_port' => 2525,
            'mail_encryption' => 'ssl',
            'mail_sender_name' => 'Lakshmipur Times',
            'contact_message_receiver_mail' => 'receiver@gmail.com',
            'pusher_app_id' => 'pusher_app_id',
            'pusher_app_key' => 'pusher_app_key',
            'pusher_app_secret' => 'pusher_app_secret',
            'pusher_app_cluster' => 'pusher_app_cluster',
            'pusher_status' => 'inactive',
            'club_point_rate' => 1,
            'club_point_status' => 'active',
            'maintenance_mode' => 0,
            'maintenance_image' => 'uploads/website-images/maintenance.jpg',
            'maintenance_title' => 'Website Under maintenance',
            'maintenance_description' => '<p>We are currently performing maintenance on our website to<br>improve your experience. Please check back later.</p>
            <p><a title="Lakshmipur Times" href="">Lakshmipur Times</a></p>',
            'last_update_date' => date('Y-m-d H:i:s'),
            'is_queable' => 'inactive',
            'comments_auto_approved' => 'active',
        ];

        foreach ($setting_data as $index => $setting_item) {
            $new_item = new Setting();
            $new_item->key = $index;
            $new_item->value = $setting_item;
            $new_item->save();
        }
    }
}
