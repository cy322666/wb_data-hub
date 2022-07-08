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
    private $key = 'ODVkNjhlYmQtYWMzOS00ZTk2LWJkZGEtM2VhNmQ1ZjYwMzdj';

    private function curl_get_contents($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function getIncomes(Request $req) {
        $dateFrom = $req->input('dateFrom');
        $url = "https://suppliers-stats.wildberries.ru/api/v1/supplier/incomes?dateFrom=$dateFrom&key={$this->key}";
        $json_response = $this->curl_get_contents($url);
        
        if ($json_response === "[]" || $json_response === "") {
            return redirect()->back()->with('error', 'Нет данных.');
        }

        if (Income::all()->count() > 0) {
            foreach (Income::all() as $income) {
                $income->delete();
            }
        }
        
        foreach (json_decode($json_response) as $income) {
            Income::create([
                'incomeId'          => $income->incomeId,
                'number'            => $income->number,
                'date'              => $income->date,
                'lastChangeDate'    => $income->lastChangeDate,
                'supplierArticle'   => $income->supplierArticle,
                'techSize'          => $income->techSize,
                'barcode'           => $income->barcode,
                'quantity'          => $income->quantity,
                'totalPrice'        => $income->totalPrice,
                'dateClose'         => $income->dateClose,
                'warehouseName'     => $income->warehouseName,
                'nmId'              => $income->nmId,
                'status'            => $income->status
            ]);
        }
        
        return redirect()->back()->with('success', 'Данные успешно получены.');
    }

    public function showIncomes() {
        dd(Income::all());
    }

    public function sendIncomes() {
        $local_incomes = Income::all();

        if ($local_incomes->count() === 0) {
            return redirect()->back()->with('error', 'Нет сохраненных локальных данных.');
        }

        $net_incomes = Income::on('mysql')->get();

        if ($net_incomes->count() > 0) {
            foreach ($net_incomes as $income) {
                $income->delete();
            }
        }

        foreach ($local_incomes as $income) {
            Income::on('mysql')->create([
                'incomeId'          => $income->incomeId,
                'number'            => $income->number,
                'date'              => $income->date,
                'lastChangeDate'    => $income->lastChangeDate,
                'supplierArticle'   => $income->supplierArticle,
                'techSize'          => $income->techSize,
                'barcode'           => $income->barcode,
                'quantity'          => $income->quantity,
                'totalPrice'        => $income->totalPrice,
                'dateClose'         => $income->dateClose,
                'warehouseName'     => $income->warehouseName,
                'nmId'              => $income->nmId,
                'status'            => $income->status
            ]);
        }
        
        return redirect()->back()->with('success', 'Данные успешно загружены.');
    }

    public function getStocks(Request $req) {
        $dateFrom = $req->input('dateFrom');
        $url = "https://suppliers-stats.wildberries.ru/api/v1/supplier/stocks?dateFrom=$dateFrom&key={$this->key}";
        $json_response = $this->curl_get_contents($url);
        
        if ($json_response === "[]" || $json_response === "") {
            return redirect()->back()->with('error', 'Нет данных.');
        }

        if (Stock::all()->count() > 0) {
            foreach (Stock::all() as $stock) {
                $stock->delete();
            }
        }
        
        foreach (json_decode($json_response) as $stock) {
            Stock::create([
                'lastChangeDate'         => $stock->lastChangeDate,
                'supplierArticle'        => $stock->supplierArticle,
                'techSize'               => $stock->techSize,
                'barcode'                => $stock->barcode,
                'quantity'               => $stock->quantity,
                'isSupply'               => $stock->isSupply,
                'isRealization'          => $stock->isRealization,
                'quantityFull'           => $stock->quantityFull,
                'quantityNotInOrders'    => $stock->quantityNotInOrders,
                'warehouse'              => $stock->warehouse,
                'warehouseName'          => $stock->warehouseName,
                'inWayToClient'          => $stock->inWayToClient,
                'inWayFromClient'        => $stock->inWayFromClient,
                'nmId'                   => $stock->nmId,
                'subject'                => $stock->subject,
                'category'               => $stock->category,
                'daysOnSite'             => $stock->daysOnSite,
                'brand'                  => $stock->brand,
                'SCCode'                 => $stock->SCCode,
                'Price'                  => $stock->Price,
                'Discount'               => $stock->Discount
            ]);
        }
        
        return redirect()->back()->with('success', 'Данные успешно получены.');
    }

    public function showStocks() {
        dd(Stock::all());
    }

    public function sendStocks() {
        $local_stocks = Stock::all();

        if ($local_stocks->count() === 0) {
            return redirect()->back()->with('error', 'Нет сохраненных локальных данных.');
        }

        $net_stocks = Stock::on('mysql')->get();

        if ($net_stocks->count() > 0) {
            foreach ($net_stocks as $stock) {
                $stock->delete();
            }
        }

        foreach ($local_stocks as $stock) {
            Stock::on('mysql')->create([
                'lastChangeDate'         => $stock->lastChangeDate,
                'supplierArticle'        => $stock->supplierArticle,
                'techSize'               => $stock->techSize,
                'barcode'                => $stock->barcode,
                'quantity'               => $stock->quantity,
                'isSupply'               => $stock->isSupply,
                'isRealization'          => $stock->isRealization,
                'quantityFull'           => $stock->quantityFull,
                'quantityNotInOrders'    => $stock->quantityNotInOrders,
                'warehouse'              => $stock->warehouse,
                'warehouseName'          => $stock->warehouseName,
                'inWayToClient'          => $stock->inWayToClient,
                'inWayFromClient'        => $stock->inWayFromClient,
                'nmId'                   => $stock->nmId,
                'subject'                => $stock->subject,
                'category'               => $stock->category,
                'daysOnSite'             => $stock->daysOnSite,
                'brand'                  => $stock->brand,
                'SCCode'                 => $stock->SCCode,
                'Price'                  => $stock->Price,
                'Discount'               => $stock->Discount
            ]);
        }
        
        return redirect()->back()->with('success', 'Данные успешно загружены.');
    }

    public function getOrders(Request $req) {
        $dateFrom = $req->input('dateFrom');
        $flag = $req->input('flag');
        $url = "https://suppliers-stats.wildberries.ru/api/v1/supplier/orders?dateFrom=$dateFrom&flag=$flag&key={$this->key}";
        
        $json_response = $this->curl_get_contents($url);

        if ($json_response === "[]" || $json_response === "") {
            return redirect()->back()->with('error', 'Нет данных.');
        }

        if (Order::all()->count() > 0) {
            foreach (Order::all() as $order) {
                $order->delete();
            }
        }

        foreach (json_decode($json_response) as $order) {
            Order::create([
                'date'               => $order->date,
                'lastChangeDate'     => $order->lastChangeDate,
                'supplierArticle'    => $order->supplierArticle,
                'techSize'           => $order->techSize,
                'barcode'            => $order->barcode,
                'totalPrice'         => $order->totalPrice,
                'discountPercent'    => $order->discountPercent,
                'warehouseName'      => $order->warehouseName,
                'oblast'             => $order->oblast,
                'incomeID'           => $order->incomeID,
                'odid'               => $order->odid,
                'nmId'               => $order->nmId,
                'subject'            => $order->subject,
                'category'           => $order->category,
                'brand'              => $order->brand,
                'isCancel'           => $order->isCancel,
                'cancel_dt'          => $order->cancel_dt,
                'gNumber'            => $order->gNumber,
                'sticker'            => $order->sticker
            ]);
        }

        return redirect()->back()->with('success', 'Данные успешно получены.');
    }

    public function showOrders() {
        dd(Order::all());
    }

    public function sendOrders() {
        $local_orders = Order::all();

        if ($local_orders->count() === 0) {
            return redirect()->back()->with('error', 'Нет сохраненных локальных данных.');
        }

        $net_orders = Order::on('mysql')->get();

        if ($net_orders->count() > 0) {
            foreach ($net_orders as $order) {
                $order->delete();
            }
        }

        foreach ($local_orders as $order) {
            Order::on('mysql')->create([
                'date'               => $order->date,
                'lastChangeDate'     => $order->lastChangeDate,
                'supplierArticle'    => $order->supplierArticle,
                'techSize'           => $order->techSize,
                'barcode'            => $order->barcode,
                'totalPrice'         => $order->totalPrice,
                'discountPercent'    => $order->discountPercent,
                'warehouseName'      => $order->warehouseName,
                'oblast'             => $order->oblast,
                'incomeID'           => $order->incomeID,
                'odid'               => $order->odid,
                'nmId'               => $order->nmId,
                'subject'            => $order->subject,
                'category'           => $order->category,
                'brand'              => $order->brand,
                'isCancel'           => $order->isCancel,
                'cancel_dt'          => $order->cancel_dt,
                'gNumber'            => $order->gNumber,
                'sticker'            => $order->sticker
            ]);
        }

        return redirect()->back()->with('success', 'Данные успешно загружены.');
    }

    public function getSales(Request $req) {
        $dateFrom = $req->input('dateFrom');
        $flag = $req->input('flag');
        $url = "https://suppliers-stats.wildberries.ru/api/v1/supplier/sales?dateFrom=$dateFrom&flag=$flag&key={$this->key}";
        
        $json_response = $this->curl_get_contents($url);
        if ($json_response === "[]" || $json_response === "") {
            return redirect()->back()->with('error', 'Нет данных.');
        }

        if (Sale::all()->count() > 0) {
            foreach (Sale::all() as $sale) {
                $sale->delete();
            }
        }

        foreach (json_decode($json_response) as $sale) {
            Sale::create([
                'date'               => $sale->date,
                'lastChangeDate'     => $sale->lastChangeDate,
                'supplierArticle'    => $sale->supplierArticle,
                'techSize'           => $sale->techSize,
                'barcode'            => $sale->barcode,
                'totalPrice'         => $sale->totalPrice,
                'discountPercent'    => $sale->discountPercent,
                'isSupply'           => $sale->isSupply,
                'isRealization'      => $sale->isRealization,
                'promoCodeDiscount'  => $sale->promoCodeDiscount,
                'warehouseName'      => $sale->warehouseName,
                'countryName'        => $sale->countryName,
                'oblastOkrugName'    => $sale->oblastOkrugName,
                'regionName'         => $sale->regionName,
                'incomeID'           => $sale->incomeID,
                'saleID'             => $sale->saleID,
                'odid'               => $sale->odid,
                'spp'                => $sale->spp,
                'forPay'             => $sale->forPay,
                'finishedPrice'      => $sale->finishedPrice,
                'priceWithDisc'      => $sale->priceWithDisc,
                'nmId'               => $sale->nmId,
                'subject'            => $sale->subject,
                'category'           => $sale->category,
                'brand'              => $sale->brand,
                'IsStorno'           => $sale->IsStorno,
                'gNumber'            => $sale->gNumber,
                'sticker'            => $sale->sticker
            ]);
        }

        return redirect()->back()->with('success', 'Данные успешно получены.');        
    }

    public function showSales() {
        dd(Sale::all());
    }

    public function sendSales() {
        $local_sales = Sale::all();

        if ($local_sales->count() === 0) {
            return redirect()->back()->with('error', 'Нет сохраненных локальных данных.');
        }

        $net_sales = Sale::on('mysql')->get();

        if ($net_sales->count() > 0) {
            foreach ($net_sales as $sale) {
                $sale->delete();
            }
        }

        foreach ($local_sales as $sale) {
            Sale::on('mysql')->create([
                'date'               => $sale->date,
                'lastChangeDate'     => $sale->lastChangeDate,
                'supplierArticle'    => $sale->supplierArticle,
                'techSize'           => $sale->techSize,
                'barcode'            => $sale->barcode,
                'totalPrice'         => $sale->totalPrice,
                'discountPercent'    => $sale->discountPercent,
                'isSupply'           => $sale->isSupply,
                'isRealization'      => $sale->isRealization,
                'promoCodeDiscount'  => $sale->promoCodeDiscount,
                'warehouseName'      => $sale->warehouseName,
                'countryName'        => $sale->countryName,
                'oblastOkrugName'    => $sale->oblastOkrugName,
                'regionName'         => $sale->regionName,
                'incomeID'           => $sale->incomeID,
                'saleID'             => $sale->saleID,
                'odid'               => $sale->odid,
                'spp'                => $sale->spp,
                'forPay'             => $sale->forPay,
                'finishedPrice'      => $sale->finishedPrice,
                'priceWithDisc'      => $sale->priceWithDisc,
                'nmId'               => $sale->nmId,
                'subject'            => $sale->subject,
                'category'           => $sale->category,
                'brand'              => $sale->brand,
                'IsStorno'           => $sale->IsStorno,
                'gNumber'            => $sale->gNumber,
                'sticker'            => $sale->sticker
            ]);
        }

        return redirect()->back()->with('success', 'Данные успешно загружены.');
    }

    public function getSalesReports(Request $req) {
        $dateFrom = $req->input('dateFrom');
        $dateto = $req->input('dateto');
        $flag = $req->input('flag');
        $limit = $req->input('limit');
        $rrdid = $req->input('rrdid');
        $url = "https://suppliers-stats.wildberries.ru/api/v1/supplier/reportDetailByPeriod?dateFrom=$dateFrom&key={$this->key}&limit=$limit&rrdid=$rrdid&dateto=$dateto";
        
        $json_response = $this->curl_get_contents($url);
        if ($json_response === "[]" || $json_response === "") {
            return redirect()->back()->with('error', 'Нет данных.');
        }

        if (SalesReport::all()->count() > 0) {
            foreach (SalesReport::all() as $salesRepor) {
                $salesRepor->delete();
            }
        }

        foreach (json_decode($json_response) as $salesReport) {
            SalesReport::create([
                'realizationreport_id'           => $salesReport->realizationreport_id,
                'suppliercontract_code'          => $salesReport->suppliercontract_code,
                'rrd_id'                         => $salesReport->rrd_id,
                'gi_id'                          => $salesReport->gi_id,
                'subject_name'                   => $salesReport->subject_name,
                'nm_id'                          => $salesReport->nm_id,
                'brand_name'                     => $salesReport->brand_name,
                'sa_name'                        => $salesReport->sa_name,
                'ts_name'                        => $salesReport->ts_name,
                'barcode'                        => $salesReport->barcode,
                'doc_type_name'                  => $salesReport->doc_type_name,
                'quantity'                       => $salesReport->quantity,
                'retail_price'                   => $salesReport->retail_price,
                'retail_amount'                  => $salesReport->retail_amount,
                'sale_percent'                   => $salesReport->sale_percent,
                'commission_percent'             => $salesReport->commission_percent,
                'office_name'                    => $salesReport->office_name,
                'supplier_oper_name'             => $salesReport->supplier_oper_name,
                'order_dt'                       => $salesReport->order_dt,
                'sale_dt'                        => $salesReport->sale_dt,
                'rr_dt'                          => $salesReport->rr_dt,
                'shk_id'                         => $salesReport->shk_id,
                'retail_price_withdisc_rub'      => $salesReport->retail_price_withdisc_rub,
                'delivery_amount'                => $salesReport->delivery_amount,
                'return_amount'                  => $salesReport->return_amount,
                'delivery_rub'                   => $salesReport->delivery_rub,
                'gi_box_type_name'               => $salesReport->gi_box_type_name,
                'product_discount_for_report'    => $salesReport->product_discount_for_report,
                'supplier_promo'                 => $salesReport->supplier_promo,
                'rid'                            => $salesReport->rid,
                'ppvz_spp_prc'                   => $salesReport->ppvz_spp_prc,
                'ppvz_kvw_prc_base'              => $salesReport->ppvz_kvw_prc_base,
                'ppvz_kvw_prc'                   => $salesReport->ppvz_kvw_prc,
                'ppvz_sales_commission'          => $salesReport->ppvz_sales_commission,
                'ppvz_for_pay'                   => $salesReport->ppvz_for_pay,
                'ppvz_reward'                    => $salesReport->ppvz_reward,
                'ppvz_vw'                        => $salesReport->ppvz_vw,
                'ppvz_vw_nds'                    => $salesReport->ppvz_vw_nds,
                'ppvz_office_id'                 => $salesReport->ppvz_office_id,
                'ppvz_office_name'               => $salesReport->ppvz_office_name ?? '',
                'ppvz_supplier_id'               => $salesReport->ppvz_supplier_id,
                'ppvz_supplier_name'             => $salesReport->ppvz_supplier_name,
                'ppvz_inn'                       => $salesReport->ppvz_inn,
                'declaration_number'             => $salesReport->declaration_number,
                'sticker_id'                     => $salesReport->sticker_id,
                'site_country'                   => $salesReport->site_country,
                'penalty'                        => $salesReport->penalty,
                'additional_payment'             => $salesReport->additional_payment
            ]);
        }

        return redirect()->back()->with('success', 'Данные успешно получены.');
    }

    public function showSalesReports() {
        dd(SalesReport::all());
    }

    public function sendSalesReports() {
        $local_salesReports = SalesReport::all();

        if ($local_salesReports->count() === 0) {
            return redirect()->back()->with('error', 'Нет сохраненных локальных данных.');
        }

        $net_salesReports = SalesReport::on('mysql')->get();

        if ($net_salesReports->count() > 0) {
            foreach ($net_salesReports as $salesReport) {
                $salesReport->delete();
            }
        }

        foreach ($local_salesReports as $salesReport) {
            SalesReport::on('mysql')->create([
                'realizationreport_id'           => $salesReport->realizationreport_id,
                'suppliercontract_code'          => $salesReport->suppliercontract_code,
                'rrd_id'                         => $salesReport->rrd_id,
                'gi_id'                          => $salesReport->gi_id,
                'subject_name'                   => $salesReport->subject_name,
                'nm_id'                          => $salesReport->nm_id,
                'brand_name'                     => $salesReport->brand_name,
                'sa_name'                        => $salesReport->sa_name,
                'ts_name'                        => $salesReport->ts_name,
                'barcode'                        => $salesReport->barcode,
                'doc_type_name'                  => $salesReport->doc_type_name,
                'quantity'                       => $salesReport->quantity,
                'retail_price'                   => $salesReport->retail_price,
                'retail_amount'                  => $salesReport->retail_amount,
                'sale_percent'                   => $salesReport->sale_percent,
                'commission_percent'             => $salesReport->commission_percent,
                'office_name'                    => $salesReport->office_name,
                'supplier_oper_name'             => $salesReport->supplier_oper_name,
                'order_dt'                       => $salesReport->order_dt,
                'sale_dt'                        => $salesReport->sale_dt,
                'rr_dt'                          => $salesReport->rr_dt,
                'shk_id'                         => $salesReport->shk_id,
                'retail_price_withdisc_rub'      => $salesReport->retail_price_withdisc_rub,
                'delivery_amount'                => $salesReport->delivery_amount,
                'return_amount'                  => $salesReport->return_amount,
                'delivery_rub'                   => $salesReport->delivery_rub,
                'gi_box_type_name'               => $salesReport->gi_box_type_name,
                'product_discount_for_report'    => $salesReport->product_discount_for_report,
                'supplier_promo'                 => $salesReport->supplier_promo,
                'rid'                            => $salesReport->rid,
                'ppvz_spp_prc'                   => $salesReport->ppvz_spp_prc,
                'ppvz_kvw_prc_base'              => $salesReport->ppvz_kvw_prc_base,
                'ppvz_kvw_prc'                   => $salesReport->ppvz_kvw_prc,
                'ppvz_sales_commission'          => $salesReport->ppvz_sales_commission,
                'ppvz_for_pay'                   => $salesReport->ppvz_for_pay,
                'ppvz_reward'                    => $salesReport->ppvz_reward,
                'ppvz_vw'                        => $salesReport->ppvz_vw,
                'ppvz_vw_nds'                    => $salesReport->ppvz_vw_nds,
                'ppvz_office_id'                 => $salesReport->ppvz_office_id,
                'ppvz_office_name'               => $salesReport->ppvz_office_name ?? '',
                'ppvz_supplier_id'               => $salesReport->ppvz_supplier_id,
                'ppvz_supplier_name'             => $salesReport->ppvz_supplier_name,
                'ppvz_inn'                       => $salesReport->ppvz_inn,
                'declaration_number'             => $salesReport->declaration_number,
                'sticker_id'                     => $salesReport->sticker_id,
                'site_country'                   => $salesReport->site_country,
                'penalty'                        => $salesReport->penalty,
                'additional_payment'             => $salesReport->additional_payment
            ]);
        }

        return redirect()->back()->with('success', 'Данные успешно загружены.');
    }

    public function getExcisesReports(Request $req) {
        $dateFrom = $req->input('dateFrom');
        $url = "https://suppliers-stats.wildberries.ru/api/v1/supplier/excise-goods?dateFrom=$dateFrom&key={$this->key}";
        
        $json_response = $this->curl_get_contents($url);
        if ($json_response === "[]" || $json_response === "") {
            return redirect()->back()->with('error', 'Нет данных.');
        }

        if (ExcisesReport::all()->count() > 0) {
            foreach (ExcisesReport::all() as $excisesReport) {
                $excisesReport->delete();
            }
        }

        foreach (json_decode($json_response) as $excisesReport) {
            ExcisesReport::create([
                'operation_id'       => $excisesReport->id,
                'finishedPrice'      => $excisesReport->finishedPrice,
                'operationTypeId'    => $excisesReport->operationTypeId,
                'fiscalDt'           => $excisesReport->fiscalDt,
                'docNumber'          => $excisesReport->docNumber,
                'fnNumber'           => $excisesReport->fnNumber,
                'regNumber'          => $excisesReport->regNumber,
                'excise'             => $excisesReport->excise,
                'date'               => $excisesReport->date
            ]);
        }

        return redirect()->back()->with('success', 'Данные успешно получены.');
    }

    public function showExcisesReports() {
        dd(ExcisesReport::all());
    }

    public function sendExcisesReports() {
        $local_excisesReports = ExcisesReport::all();

        if ($local_excisesReports->count() === 0) {
            return redirect()->back()->with('error', 'Нет сохраненных локальных данных.');
        }

        $net_excisesReports = ExcisesReport::on('mysql')->get();

        if ($net_excisesReports->count() > 0) {
            foreach ($net_excisesReports as $excisesReport) {
                $excisesReport->delete();
            }
        }

        foreach ($local_excisesReports as $excisesReport) {
            ExcisesReport::on('mysql')->create([
                'operation_id'       => $excisesReport->id,
                'finishedPrice'      => $excisesReport->finishedPrice,
                'operationTypeId'    => $excisesReport->operationTypeId,
                'fiscalDt'           => $excisesReport->fiscalDt,
                'docNumber'          => $excisesReport->docNumber,
                'fnNumber'           => $excisesReport->fnNumber,
                'regNumber'          => $excisesReport->regNumber,
                'excise'             => $excisesReport->excise,
                'date'               => $excisesReport->date
            ]);
        }

        return redirect()->back()->with('success', 'Данные успешно загружены.');
    }
}
