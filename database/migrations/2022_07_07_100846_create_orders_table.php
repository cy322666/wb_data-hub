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
        Schema::create('orders', function (Blueprint $table) {
            // Заказы
            $table->id();
            $table->date('date');                   // дата заказа : "2021-09-01T14:17:37"
            $table->dateTime('lastChangeDate');     // дата и время обновления информации в сервисе : "2021-09-01T14:17:37"
            $table->string('supplierArticle', 75);  // ваш артикул
            $table->string('techSize', 30);         // размер
            $table->string('barcode', 30);          // штрих-код
            $table->decimal('totalPrice', 10, 2);   // цена до согласованной скидки/промо/спп
            $table->integer('discountPercent');     // согласованный итоговый дисконт
            $table->string('warehouseName', 50);    // склад отгрузки
            $table->string('oblast', 200);          // область
            $table->integer('incomeID');            // номер поставки
            $table->BigInteger('odid');             // уникальный идентификатор позиции заказа
            $table->integer('nmId');                // Код WB
            $table->string('subject', 50);          // предмет
            $table->string('category', 50);         // категория
            $table->string('brand', 50);            // бренд
            $table->integer('isCancel');            // Отмена заказа. 1 – заказ отменен до оплаты
            $table->dateTime('cancel_dt');          // "0001-01-01T00:00:00"
            $table->string('gNumber', 50);          // номер заказа
            $table->string('sticker', 50);          // аналогично стикеру, который клеится на товар в процессе сборки
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
        Schema::dropIfExists('orders');
    }
};
