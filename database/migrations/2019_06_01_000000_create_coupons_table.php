<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateCouponsTable extends Migration
    {
        public function up()
        {
            Schema::create('coupons', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('amount')->default(0);
                $table->integer('max_usable')->default(-1);
                $table->integer('used')->default(0);
                $table->integer('is_percent')->default(0);
                $table->string('code')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('coupons');
        }
    }
