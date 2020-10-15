<?php

    use App\Models\Permission;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePermissionsTable extends Migration
    {
        public function up()
        {
            Schema::create('permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('permission')->unique();
                $table->timestamps();
            });

            $permissions = [
                'access_backend',
                'jabber_newsletter',
                'manage_articles',
                'manage_faqs',
                'manage_faqs_categories',
                'manage_products',
                'manage_products_categories',
                'manage_tickets',
                'manage_tickets_categories',
                'system_settings',
                'manage_bitcoin_wallet',
                'manage_creditcards',
                'manage_users',
                'manage_users_permissions',
                'manage_orders',
                'jabber_login',
                'system_payments',
                'manage_coupons',
                'manage_delivery_methods',
                'manage_design',
                'manage_media',
                'system_bonus',
            ];

            foreach ($permissions as $permission) {
                Permission::create([
                    'permission' => $permission,
                ]);
            }
        }

        public function down()
        {
            Schema::dropIfExists('permissions');
        }
    }
