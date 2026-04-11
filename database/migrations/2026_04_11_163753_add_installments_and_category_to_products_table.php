<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
        $table->unsignedTinyInteger('installments_count')->default(0)->after('price');
    });
}



    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn(['category_id', 'installments_count']);
    });
}
};
