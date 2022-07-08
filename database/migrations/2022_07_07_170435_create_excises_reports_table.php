<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excises_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operation_id'); // внутренний код операции
            $table->decimal('finishedPrice', 10, 2); // цена товара с учетом НДС
            $table->integer('operationTypeId'); //  тип операции (тип операции 1 - продажа, 2 - возврат)
            $table->dateTime('fiscalDt'); // время фискализации
            $table->unsignedInteger('docNumber'); // номер фискального документа
            $table->string('fnNumber', 30); // номер фискального накопителя
            $table->string('regNumber', 30); // регистрационный номер ККТ
            $table->string('excise', 30); // акциз (он же киз)
            $table->date('date'); // дата, когда данные появились в системе (по ним и отслеживать изменение, появление новых)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excises_reports');
    }
};
