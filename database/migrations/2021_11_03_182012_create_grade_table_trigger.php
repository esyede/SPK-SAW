<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGradeTableTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE TRIGGER create_grade AFTER INSERT ON users FOR EACH ROW EXECUTE BEGIN
        INSERT INTO grades (user_id, total_grade_value, created_at, updated_at)  VALUES(NEW.id, 0.0, now(), now()); END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `create_grade`');
    }
}
