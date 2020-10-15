<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersCouponsCheckoutsTable extends Migration
    {
        public function up()
        {
            Schema::create('users_coupons_checkouts', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->default(0);
                $table->string('coupon_code')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_coupons_checkouts');
        }
    }
