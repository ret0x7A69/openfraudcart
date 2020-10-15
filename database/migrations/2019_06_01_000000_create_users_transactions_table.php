<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersTransactionsTable extends Migration
    {
        public function up()
        {
            Schema::create('users_transactions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->default(0);
                $table->text('wallet')->nullable();
                $table->text('txid')->nullable();
                $table->enum('status', ['paid', 'pending', 'waiting'])->default('waiting');
                $table->string('payment_method')->default('btc');
                $table->bigInteger('amount')->default(0);
                $table->bigInteger('amount_cent')->default(0);
                $table->integer('confirmations')->default(0);
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_transactions');
        }
    }
