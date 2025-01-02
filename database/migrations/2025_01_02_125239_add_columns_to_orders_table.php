<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('email')->after('user_id')->nullable();
            $table->enum('custom_logo', [1, 0])->after('email')->default(0);
            $table->string('logo')->after('custom_logo')->nullable();
            $table->string('address')->after('logo')->nullable();
            $table->string('phone_number')->after('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            collect([
                'email',
                'custom_logo',
                'logo',
                'address',
                'phone_number'
            ])->each(function($column) use ($table) {
                $table->dropColumn($column);
            });
        });
    }
};
