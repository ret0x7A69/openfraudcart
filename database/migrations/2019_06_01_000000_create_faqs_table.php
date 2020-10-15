<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateFaqsTable extends Migration
    {
        public function up()
        {
            Schema::create('faqs', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('category_id')->default(0);
                $table->text('question')->nullable();
                $table->text('answer')->nullable();
                $table->integer('ordering')->default(1);
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('faqs');
        }
    }
