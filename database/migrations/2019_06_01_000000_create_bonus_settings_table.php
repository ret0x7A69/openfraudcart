<?php

    use App\Models\Bonus;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateBonusSettingsTable extends Migration
    {
        public function up()
        {
            Schema::create('bonus_settings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('min_amount')->default(0);
                $table->string('percent')->default('1');
                $table->timestamps();
            });

            $bonuses = [
                ['1.1', 10000],
                ['1.15', 50000],
                ['1.2', 100000],
                ['1.25', 250000],
                ['1.3', 500000],
                ['1.35', 1000000],
            ];

            foreach ($bonuses as $bonus) {
                Bonus::create([
                    'percent' => $bonus[0],
                    'min_amount' => $bonus[1],
                ]);
            }
        }

        public function down()
        {
            Schema::dropIfExists('bonus_settings');
        }
    }
