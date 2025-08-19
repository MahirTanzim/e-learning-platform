<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->decimal('payment_amount', 10, 2)->nullable()->after('progress');
            $table->string('payment_status')->default('pending')->after('payment_amount');
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('transaction_id')->nullable()->after('payment_method');
            $table->timestamp('payment_date')->nullable()->after('transaction_id');
        });
    }

    public function down()
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn([
                'payment_amount',
                'payment_status',
                'payment_method',
                'transaction_id',
                'payment_date'
            ]);
        });
    }
};
