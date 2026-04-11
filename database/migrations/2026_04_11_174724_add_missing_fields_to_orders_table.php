<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('shipping_address');
            $table->text('notes')->nullable()->after('phone');
            $table->unsignedTinyInteger('installment_plan')->default(0)->after('total_amount');
            $table->decimal('installment_amount', 10, 2)->nullable()->after('installment_plan');
            $table->date('first_installment_date')->nullable()->after('installment_amount');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['phone', 'notes', 'installment_plan', 'installment_amount', 'first_installment_date']);
        });
    }
};