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
        Schema::create('sales', function (Blueprint $table) {
            // Продажи
            $table->id();
            $table->date('date');                   // дата продажи : "2021-09-01T14:17:37"
            $table->dateTime('lastChangeDate');     // дата и время обновления информации в сервисе : "2021-09-01T14:17:37"
            $table->string('supplierArticle', 75);  // ваш артикул
            $table->string('techSize', 30);         // размер
            $table->string('barcode', 30);          // штрих-код
            $table->decimal('totalPrice', 10, 2);   // начальная розничная цена товара
            $table->float('discountPercent');       // согласованная скидка на товар
            $table->integer('isSupply');            // договор поставки
            $table->integer('isRealization');       // договор реализации
            $table->float('promoCodeDiscount');     // согласованный промокод
            $table->string('warehouseName', 50);    // склад отгрузки
            $table->string('countryName', 200);     // страна
            $table->string('oblastOkrugName', 200); // округ
            $table->string('regionName', 200);      // регион
            $table->integer('incomeID');            // номер поставки
            $table->string('saleID', 15);              // уникальный идентификатор продажи/возврата (SXXXXXXXXXX — продажа, RXXXXXXXXXX —
                                                    // возврат, DXXXXXXXXXXX — доплата, 'AXXXXXXXXX' – сторно продаж (все значения полей как у
                                                    // продажи, но поля с суммами и кол-вом с минусом как в возврате). SaleID='BXXXXXXXXX' - сторно
                                                    // возврата(все значения полей как у возврата, но поля с суммами и кол-вом с плюсом, в
                                                    // противоположность возврату))
            $table->BigInteger('odid');                // уникальный идентификатор позиции заказа
            $table->float('spp');                   // согласованная скидка постоянного покупателя (СПП)
            $table->decimal('forPay', 10, 2);       // к перечислению поставщику
            $table->decimal('finishedPrice', 10, 2);// фактическая цена из заказа (с учетом всех скидок, включая и от ВБ)
            $table->decimal('priceWithDisc', 10, 2);// цена, от которой считается вознаграждение поставщика
            $table->integer('nmId');                // Код WB
            $table->string('subject', 50);          // предмет
            $table->string('category', 50);         // категория
            $table->string('brand', 50);            // бренд
            $table->integer('IsStorno');            
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
        Schema::dropIfExists('sales');
    }
};
