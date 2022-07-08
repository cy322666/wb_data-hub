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
        Schema::create('stocks', function (Blueprint $table) {
            // Склад
            $table->id();
            $table->dateTime('lastChangeDate');     // дата и время обновления информации в сервисе : "2022-07-01T07:42:01.793"
            $table->string('supplierArticle', 75);  // артикул поставщика
            $table->string('techSize', 30);         // размер
            $table->string('barcode', 30);          // штрих-код
            $table->integer('quantity');            // кол-во доступное для продажи
            $table->integer('isSupply');            // договор поставки
            $table->integer('isRealization');       // договор реализации
            $table->integer('quantityFull');        // кол-во полное
            $table->integer('quantityNotInOrders'); // кол-во не в заказе
            $table->integer('warehouse');           // уникальный идентификатор склада
            $table->string('warehouseName', 50);    // название склада
            $table->integer('inWayToClient');       // в пути к клиенту (штук)
            $table->integer('inWayFromClient');     // в пути от клиента (штук)
            $table->integer('nmId');                // код WB
            $table->string('subject', 50);          // предмет
            $table->string('category', 50);         // категория
            $table->integer('daysOnSite');          // кол-во дней на сайте
            $table->string('brand', 50);            // бренд
            $table->string('SCCode', 50);           // код контракта
            $table->decimal('Price', 10, 2);        // цена из товара
            $table->integer('Discount');            // скидка на товар установленная продавцом
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
        Schema::dropIfExists('stocks');
    }
};
