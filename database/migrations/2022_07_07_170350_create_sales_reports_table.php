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
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('realizationreport_id'); // Номер отчета
            $table->string('suppliercontract_code', 30)->nullable(); // Договор
            $table->unsignedBigInteger('rrd_id'); // Номер строки
            $table->unsignedBigInteger('gi_id'); // Номер поставки
            $table->string('subject_name', 30); // Предмет
            $table->unsignedBigInteger('nm_id'); // Артикул
            $table->string('brand_name', 30); // Бренд
            $table->string('sa_name', 30); // Артикул поставщика
            $table->string('ts_name', 30); // Размер
            $table->string('barcode', 30)->nullable(); // Баркод
            $table->string('doc_type_name', 30); // Тип документа
            $table->integer('quantity'); // Количество
            $table->decimal('retail_price', 10, 2); // Цена розничная
            $table->decimal('retail_amount', 10, 2); // Сумма продаж(Возвратов)
            $table->float('sale_percent'); // Согласованная скидка
            $table->float('commission_percent'); // Процент комиссии
            $table->string('office_name', 30); // Склад
            $table->string('supplier_oper_name', 30); // Обоснование для оплаты
            $table->dateTime('order_dt'); // Даты заказа
            $table->dateTime('sale_dt'); // Дата продажи
            $table->dateTime('rr_dt'); // Дата операции
            $table->unsignedBigInteger('shk_id'); // ШК
            $table->decimal('retail_price_withdisc_rub', 10, 2); // Цена розничная с учетом согласованной скидки
            $table->unsignedInteger('delivery_amount'); // Кол-во доставок
            $table->unsignedInteger('return_amount'); // Кол-во возвратов
            $table->decimal('delivery_rub', 10, 2); // Стоимость логистики
            $table->string('gi_box_type_name', 30); // Тип коробов
            $table->float('product_discount_for_report'); // Согласованный продуктовый дисконт
            $table->integer('supplier_promo'); // Промокод
            $table->unsignedBigInteger('rid'); // Уникальный идентификатор позиции заказа
            $table->float('ppvz_spp_prc'); // Скидка постоянного Покупателя (СПП)
            $table->float('ppvz_kvw_prc_base'); // Размер кВВ без НДС, % Базовый
            $table->float('ppvz_kvw_prc'); // Итоговый кВВ без НДС, %
            $table->float('ppvz_sales_commission'); // Вознаграждение с продаж до вычета услуг поверенного, без НДС
            $table->float('ppvz_for_pay'); // К перечислению Продавцу за реализованный Товар
            $table->float('ppvz_reward'); // Возмещение Расходов услуг поверенного
            $table->float('ppvz_vw'); // Вознаграждение Вайлдберриз (ВВ), без НДС
            $table->float('ppvz_vw_nds'); // НДС с Вознаграждения Вайлдберриз
            $table->unsignedBigInteger('ppvz_office_id'); // Номер офиса
            $table->string('ppvz_office_name', 30); // Наименование офиса доставки
            $table->unsignedBigInteger('ppvz_supplier_id'); // Номер партнера
            $table->string('ppvz_supplier_name', 200); // Партнер
            $table->string('ppvz_inn', 30); // ИНН партнера
            $table->string('declaration_number', 30); // Номер таможенной декларации
            $table->string('sticker_id', 30); // Аналогично стикеру, который клеится на товар в процессе сборки
            $table->string('site_country', 30); // Страна продажи
            $table->decimal('penalty', 10, 2)->nullable(); // 
            $table->integer('additional_payment')->nullable(); // 
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
        Schema::dropIfExists('sales_reports');
    }
};
