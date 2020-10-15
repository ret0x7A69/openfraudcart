<?php

    use App\Models\Permission;
    use App\Models\User;
    use App\Models\UserPermission;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersTable extends Migration
    {
        public function up()
        {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('username')->unique();
                $table->string('email')->nullable()->unique();
                $table->string('language')->default('de');
                $table->string('jabber_id')->unique();
                $table->integer('balance_in_cent')->default(0);
                $table->integer('newsletter_enabled')->default(0);
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });

            $user = User::create([
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'language' => 'de',
                'jabber_id' => 'admin@example.com',
                'balance_in_cent' => 0,
                'newsletter_enabled' => 0,
                'password' => \Hash::make('123456'),
            ]);

            if ($user != null) {
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

                foreach ($permissions as $permissionString) {
                    $permission = Permission::where('permission', $permissionString)->get()->first();

                    if ($permission != null) {
                        UserPermission::create([
                            'user_id' => $user->id,
                            'permission_id' => $permission->id,
                        ]);
                    }
                }
            }
        }

        public function down()
        {
            Schema::dropIfExists('users');
        }
    }
