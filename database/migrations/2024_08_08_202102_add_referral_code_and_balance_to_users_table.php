<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'referral_code')) {
                $table->string('referral_code', 12)->unique()->nullable();
            }
            if (!Schema::hasColumn('users', 'balance')) {
                $table->decimal('balance', 15, 2)->default(0);
            }
            if (!Schema::hasColumn('users', 'referrer_id')) {
                $table->foreignId('referrer_id')->nullable()->constrained('users')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'referral_code')) {
                $table->dropColumn('referral_code');
            }
            if (Schema::hasColumn('users', 'balance')) {
                $table->dropColumn('balance');
            }
            if (Schema::hasColumn('users', 'referrer_id')) {
                $table->dropForeign(['referrer_id']);
                $table->dropColumn('referrer_id');
            }
        });
    }


};
