<?php

    use App\Models\Setting;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateSettingsTable extends Migration
    {
        public function up()
        {
            Schema::create('settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('key');
                $table->text('value');
                $table->string('type', 20)->default('string');
                $table->string('before_add')->nullable();
                $table->string('after_add')->nullable();
                $table->timestamps();
            });

            $settings = [
                ['app.name', 'OpenFraudCart', 'string'],
                ['app.url', 'http://localhost', 'string'],
                ['app.asset_url', '/assets/', 'string'],
                ['app.media_url', '/media/', 'string'],
                ['app.timezone', 'Europe/Berlin', 'string'],
                ['app.cipher', 'AES-256-CBC', 'string'],
                ['mail.from.name', 'OpenFraudCart', 'string'],
                ['mail.from.address', '', 'string'],
                ['mail.port', '587', 'string'],
                ['mail.host', '', 'string'],
                ['mail.driver', 'smtp', 'string'],
                ['mail.username', '', 'string'],
                ['mail.password', '', 'string'],
                ['mail.encryption', 'tls', 'string'],
                ['backend.name', 'OpenFraudCart Panel', 'string'],
                ['app.access_only_for_users', '1', 'bool'],
                ['shop.replace_rules', '0', 'int'],
                ['shop.currency', 'EUR', 'string'],
                ['shop.btc_confirms_needed', '1', 'int'],
                ['shop.total_sells', '0', 'int'],
                ['jabber.address', '', 'string'],
                ['jabber.username', '', 'string'],
                ['jabber.password', '', 'string'],
                ['bitcoin.api', '', 'string'],
                ['register.newsletter_enabled', '1', 'bool'],
                ['shop.creditcards.enabled', '0', 'bool'],
                ['bitcoin.primarywallet', '', 'string'],
                ['app.available.locales', 'de,en', 'string'],
                ['app.locale', 'de', 'string'],
                ['shop.bonus_in_percent', '0.95', 'string'],
                ['theme.color1', 'fb1313', 'string'],
                ['theme.color2', 'fb1313', 'string'],
                ['theme.color3', 'fb1313', 'string'],
                ['theme.color4', 'fb1313', 'string'],
                ['theme.color5', 'fb1313', 'string'],
                ['theme.color6', 'fb1313', 'string'],
                ['theme.color7', 'fb1313', 'string'],
                ['theme.color8', 'fb1313', 'string'],
                ['theme.color9', 'fb1313', 'string'],
                ['theme.color.enable', '0', 'bool'],
                ['theme.logo', '', 'string'],
                ['theme.favicon', '', 'string'],
                ['theme.background', '', 'string'],
                ['theme.custom.css', 'body {
                    /*
                    background-color: #fff;
                    background-repeat: no-repeat;
                    background-position: center;
                    background-image: url(\'\');
                    */
                }', 'string'],
                ['import.custom.delimiter', '', 'string'],
                ['api.enabled', '1', 'bool'],
                ['api.key', encrypt(rand(1000, 9999).'-'.rand(1000, 9999).'-'.rand(1000, 9999)), 'string'],
            ];

            foreach ($settings as $setting) {
                Setting::create([
                    'key' => $setting[0],
                    'value' => $setting[1],
                    'type' => $setting[2],
                ]);
            }
        }

        public function down()
        {
            Schema::dropIfExists('settings');
        }
    }
