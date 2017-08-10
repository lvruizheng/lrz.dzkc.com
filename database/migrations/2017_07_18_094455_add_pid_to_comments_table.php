<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPidToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('website');
            $table->dropColumn('email');
            $table->tinyInteger('type')->unsigned()->comment('评/回,类别');
            $table->integer('p_id')->comment('父级ID');
            $table->integer('commend')->comment('点赞数');
            $table->integer('reply')->comment('回复数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
        });
    }
}
