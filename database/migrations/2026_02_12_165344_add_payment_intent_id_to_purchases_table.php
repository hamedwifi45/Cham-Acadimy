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
        Schema::table('purchases', function (Blueprint $table) {
             // إضافة عمود payment_intent_id
            $table->string('payment_intent_id')->nullable()->after('status');
            
            // إضافة عمود لتسجيل وقت الدفع الفعلي
            $table->timestamp('paid_at')->nullable()->after('payment_intent_id');
            
            // إضافة فهرس (index) لتحسين الأداء عند البحث
            $table->index('payment_intent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            // حذف الأعمدة المضافة
            $table->dropIndex(['payment_intent_id']);
            $table->dropColumn(['payment_intent_id', 'paid_at']);
        });
    }
};
