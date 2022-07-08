<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Income;
use App\Models\Stock;
use App\Models\Order;
use App\Models\Sale;
use App\Models\SalesReport;
use App\Models\ExcisesReport;

class WBAPIController extends Controller
{
    private function curl_get_contents($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function getAllData() {
        $key = 'ODVkNjhlYmQtYWMzOS00ZTk2LWJkZGEtM2VhNmQ1ZjYwMzdj';
        $dateFrom = date('Y-m-d\TH:i:s', strtotime('2022-07-01  00:00:00'));
        $dateto = date('Y-m-d', strtotime('2022-07-07'));
        $flag = 1; // 1 - записи определенной даты dateFrom (1 день), 0 - записи начиная с даты dateFrom (c dateFrom по самую новую запись)
        $limit = 1000;
        $rrdid = 0;
        $url_incomes = "https://suppliers-stats.wildberries.ru/api/v1/supplier/incomes?dateFrom=$dateFrom&key=$key";
        $url_stocks = "https://suppliers-stats.wildberries.ru/api/v1/supplier/stocks?dateFrom=$dateFrom&key=$key";
        $url_orders = "https://suppliers-stats.wildberries.ru/api/v1/supplier/orders?dateFrom=$dateFrom&flag=$flag&key=$key";
        $url_sales = "https://suppliers-stats.wildberries.ru/api/v1/supplier/sales?dateFrom=$dateFrom&flag=$flag&key=$key";
        $url_reportDetailByPeriod = "https://suppliers-stats.wildberries.ru/api/v1/supplier/reportDetailByPeriod?dateFrom=$dateFrom&key=$key&limit=$limit&rrdid=$rrdid&dateto=$dateto";
        $url_exciseGoods = "https://suppliers-stats.wildberries.ru/api/v1/supplier/excise-goods?dateFrom=2020-07-01T00:00:00&key=$key";

        $obj_exciseReports = json_decode($this->curl_get_contents($url_exciseGoods));

        foreach ($obj_exciseReports as $exciseReport) {
            ExcisesReport::create([
                'operation_id'       => $exciseReport->id,
                'finishedPrice'      => $exciseReport->finishedPrice,
                'operationTypeId'    => $exciseReport->operationTypeId,
                'fiscalDt'           => $exciseReport->fiscalDt,
                'docNumber'          => $exciseReport->docNumber,
                'fnNumber'           => $exciseReport->fnNumber,
                'regNumber'          => $exciseReport->regNumber,
                'excise'             => $exciseReport->excise,
                'date'               => $exciseReport->date
            ]);
        }

        dd(ExcisesReport::all()->first(), ExcisesReport::all());

        // $obj_salesReports = json_decode($this->curl_get_contents($url_reportDetailByPeriod));

        // foreach ($obj_salesReports as $salesReport) {
        //     SalesReport::create([
        //         'realizationreport_id'           => $salesReport->realizationreport_id,
        //         'suppliercontract_code'          => $salesReport->suppliercontract_code,
        //         'rrd_id'                         => $salesReport->rrd_id,
        //         'gi_id'                          => $salesReport->gi_id,
        //         'subject_name'                   => $salesReport->subject_name,
        //         'nm_id'                          => $salesReport->nm_id,
        //         'brand_name'                     => $salesReport->brand_name,
        //         'sa_name'                        => $salesReport->sa_name,
        //         'ts_name'                        => $salesReport->ts_name,
        //         'barcode'                        => $salesReport->barcode,
        //         'doc_type_name'                  => $salesReport->doc_type_name,
        //         'quantity'                       => $salesReport->quantity,
        //         'retail_price'                   => $salesReport->retail_price,
        //         'retail_amount'                  => $salesReport->retail_amount,
        //         'sale_percent'                   => $salesReport->sale_percent,
        //         'commission_percent'             => $salesReport->commission_percent,
        //         'office_name'                    => $salesReport->office_name,
        //         'supplier_oper_name'             => $salesReport->supplier_oper_name,
        //         'order_dt'                       => $salesReport->order_dt,
        //         'sale_dt'                        => $salesReport->sale_dt,
        //         'rr_dt'                          => $salesReport->rr_dt,
        //         'shk_id'                         => $salesReport->shk_id,
        //         'retail_price_withdisc_rub'      => $salesReport->retail_price_withdisc_rub,
        //         'delivery_amount'                => $salesReport->delivery_amount,
        //         'return_amount'                  => $salesReport->return_amount,
        //         'delivery_rub'                   => $salesReport->delivery_rub,
        //         'gi_box_type_name'               => $salesReport->gi_box_type_name,
        //         'product_discount_for_report'    => $salesReport->product_discount_for_report,
        //         'supplier_promo'                 => $salesReport->supplier_promo,
        //         'rid'                            => $salesReport->rid,
        //         'ppvz_spp_prc'                   => $salesReport->ppvz_spp_prc,
        //         'ppvz_kvw_prc_base'              => $salesReport->ppvz_kvw_prc_base,
        //         'ppvz_kvw_prc'                   => $salesReport->ppvz_kvw_prc,
        //         'ppvz_sales_commission'          => $salesReport->ppvz_sales_commission,
        //         'ppvz_for_pay'                   => $salesReport->ppvz_for_pay,
        //         'ppvz_reward'                    => $salesReport->ppvz_reward,
        //         'ppvz_vw'                        => $salesReport->ppvz_vw,
        //         'ppvz_vw_nds'                    => $salesReport->ppvz_vw_nds,
        //         'ppvz_office_id'                 => $salesReport->ppvz_office_id,
        //         'ppvz_office_name'               => $salesReport->ppvz_office_name ?? '',
        //         'ppvz_supplier_id'               => $salesReport->ppvz_supplier_id,
        //         'ppvz_supplier_name'             => $salesReport->ppvz_supplier_name,
        //         'ppvz_inn'                       => $salesReport->ppvz_inn,
        //         'declaration_number'             => $salesReport->declaration_number,
        //         'sticker_id'                     => $salesReport->sticker_id,
        //         'site_country'                   => $salesReport->site_country,
        //         'penalty'                        => $salesReport->penalty,
        //         'additional_payment'             => $salesReport->additional_payment
        //     ]);
        // }

        // dd(SalesReport::all()->first(), SalesReport::all());

        // $json_orders= file_get_contents($url_orders);
        // $obj_orders = json_decode($json_orders);

        // foreach ($obj_orders as $order) {
        //     Order::create([
        //         'date'               => $order->date,
        //         'lastChangeDate'     => $order->lastChangeDate,
        //         'supplierArticle'    => $order->supplierArticle,
        //         'techSize'           => $order->techSize,
        //         'barcode'            => $order->barcode,
        //         'totalPrice'         => $order->totalPrice,
        //         'discountPercent'    => $order->discountPercent,
        //         'warehouseName'      => $order->warehouseName,
        //         'oblast'             => $order->oblast,
        //         'incomeID'           => $order->incomeID,
        //         'odid'               => $order->odid,
        //         'nmId'               => $order->nmId,
        //         'subject'            => $order->subject,
        //         'category'           => $order->category,
        //         'brand'              => $order->brand,
        //         'isCancel'           => $order->isCancel,
        //         'cancel_dt'          => $order->cancel_dt,
        //         'gNumber'            => $order->gNumber,
        //         'sticker'            => $order->sticker
        //     ]);
        // }

        // dd(Order::all()->first());

        // foreach ($obj_stocks as $stock) {
        //     Stock::create([
        //         'lastChangeDate'         => $stock->lastChangeDate,
        //         'supplierArticle'        => $stock->supplierArticle,
        //         'techSize'               => $stock->techSize,
        //         'barcode'                => $stock->barcode,
        //         'quantity'               => $stock->quantity,
        //         'isSupply'               => $stock->isSupply,
        //         'isRealization'          => $stock->isRealization,
        //         'quantityFull'           => $stock->quantityFull,
        //         'quantityNotInOrders'    => $stock->quantityNotInOrders,
        //         'warehouse'              => $stock->warehouse,
        //         'warehouseName'          => $stock->warehouseName,
        //         'inWayToClient'          => $stock->inWayToClient,
        //         'inWayFromClient'        => $stock->inWayFromClient,
        //         'nmId'                   => $stock->nmId,
        //         'subject'                => $stock->subject,
        //         'category'               => $stock->category,
        //         'daysOnSite'             => $stock->daysOnSite,
        //         'brand'                  => $stock->brand,
        //         'SCCode'                 => $stock->SCCode,
        //         'Price'                  => $stock->Price,
        //         'Discount'               => $stock->Discount
        //     ]);
        // }

        // $json_stocks= file_get_contents($url_stocks);
        // $obj_stocks = json_decode($json_stocks);

        // foreach ($obj_stocks as $stock) {
        //     Stock::create([
        //         'lastChangeDate'         => $stock->lastChangeDate,
        //         'supplierArticle'        => $stock->supplierArticle,
        //         'techSize'               => $stock->techSize,
        //         'barcode'                => $stock->barcode,
        //         'quantity'               => $stock->quantity,
        //         'isSupply'               => $stock->isSupply,
        //         'isRealization'          => $stock->isRealization,
        //         'quantityFull'           => $stock->quantityFull,
        //         'quantityNotInOrders'    => $stock->quantityNotInOrders,
        //         'warehouse'              => $stock->warehouse,
        //         'warehouseName'          => $stock->warehouseName,
        //         'inWayToClient'          => $stock->inWayToClient,
        //         'inWayFromClient'        => $stock->inWayFromClient,
        //         'nmId'                   => $stock->nmId,
        //         'subject'                => $stock->subject,
        //         'category'               => $stock->category,
        //         'daysOnSite'             => $stock->daysOnSite,
        //         'brand'                  => $stock->brand,
        //         'SCCode'                 => $stock->SCCode,
        //         'Price'                  => $stock->Price,
        //         'Discount'               => $stock->Discount
        //     ]);
        // }

        // dd(Stock::all()->first());


        // $json_incomes = file_get_contents($url_incomes);
        // $obj_incomes = json_decode($json_incomes);

        // if (Income::all()->count() > 0) {
        //     foreach (Income::all() as $income) {
        //         $income->delete();
        //     }
        // }

        // foreach ($obj_incomes as $income) {
        //     Income::create([
        //         'incomeId'          => $income->incomeId,
        //         'number'            => $income->number,
        //         'date'              => $income->date,
        //         'lastChangeDate'    => $income->lastChangeDate,
        //         'supplierArticle'   => $income->supplierArticle,
        //         'techSize'          => $income->techSize,
        //         'barcode'           => $income->barcode,
        //         'quantity'          => $income->quantity,
        //         'totalPrice'        => $income->totalPrice,
        //         'dateClose'         => $income->dateClose,
        //         'warehouseName'     => $income->warehouseName,
        //         'nmId'              => $income->nmId,
        //         'status'            => $income->status
        //     ]);
        // }

        dd(Income::all()->first());

        // $json_stocks = file_get_contents($url_stocks);
        // $json_orders = file_get_contents($url_orders);
        // $json_sales = file_get_contents($url_sales);
    }
}
