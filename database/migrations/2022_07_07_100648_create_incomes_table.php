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
        Schema::create('incomes', function (Blueprint $table) {
            // Поставки
            $table->id();
            $table->integer('incomeId');            // номер поставки
            $table->string("number", 40);           // номер УПД
            $table->date('date');                   // дата поступления
            $table->dateTime('lastChangeDate');     // дата и время обновления информации в сервисе : "2022-07-01T07:42:01.793"
            $table->string('supplierArticle', 75);  // ваш артикул
            $table->string('techSize', 30);         // размер
            $table->string('barcode', 30);          // штрих-код
            $table->integer('quantity');            // кол-во
            $table->decimal('totalPrice', 10, 2);   // цена из УПД
            $table->date('dateClose');              // дата принятия (закрытия) у нас
            $table->string('warehouseName', 50);    // название склада
            $table->integer('nmId');                // Код WB
            $table->string('status', 50);           // Текущий статус поставки
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
        Schema::dropIfExists('incomes');
    }
};
