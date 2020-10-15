<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateFaqsCategoriesTable extends Migration
    {
        public function up()
        {
            Schema::create('faqs_categories', function (Blueprint $table) {
                $table->increments('id');
                $table->text('name')->nullable();
                $table->text('slug')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('faqs_categories');
        }
    }
