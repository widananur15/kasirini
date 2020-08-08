<?php

namespace App\Http\Controllers;

use App\LevelPriceProduct;
use App\Product;
use App\SellPriceProduct;
use Illuminate\Http\Request;
use DB;
use mysql_xdevapi\Exception;

class ProductController extends Controller
{
    public function addProduct(Request $request) {

        DB::beginTransaction();

        try {

            $product = new Product();
            $product->product_name = $request->get("name");
            $product->save();

            DB::commit();

            return redirect("/home");

        } catch(\Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }

    }

    public function addLevelPriceProduct(Request $request) {

        DB::beginTransaction();

        try {

            $product = new LevelPriceProduct();
            $product->level_price_name = $request->get("name");
            $product->save();

            DB::commit();

            return redirect("/home");

        } catch(\Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }

    }

    public function addSellPriceProduct(Request $request) {

        DB::beginTransaction();

        try {

            $product = Product::find($request->get("product_id"));

            if( is_null($product) ) {
                throw new \Exception("Product not found");
            }

            $levelPriceProduct = LevelPriceProduct::find($request->get("level_price_id"));

            if( is_null($levelPriceProduct) ) {
                throw new \Exception("Level price product not found");
            }

            $sellPriceProduct = new SellPriceProduct();
            $sellPriceProduct->product_id = $request->get("product_id");
            $sellPriceProduct->level_price_id = $request->get("level_price_id");
            $sellPriceProduct->gross_sell_price = $request->get("gross_sell_price");
            $sellPriceProduct->save();

            DB::commit();

            return redirect("/home");


        } catch(\Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }

    }

    public function getLevelPriceProduct() {

        $levelPriceList = LevelPriceProduct::all();

        $response = response()->json([
            "success" => true,
            "result" => $levelPriceList
        ]);

        return $response;

    }

    public function getProductList() {

        $productList = Product::all();

        $response = response()->json([
            "success" => true,
            "result" => $productList
        ]);

        return $response;

    }

    public function getSellPriceProductListByIndex(Request $request) {
        $productId = $request->get("product_id");
        $levelPriceId = $request->get("level_price_id");

        \Log::debug($productId);
        \Log::debug($levelPriceId);

        $sellPriceProduct = SellPriceProduct::where("product_id", $productId)
            ->where("level_price_id", $levelPriceId)
            ->first();

        $response = response()->json([
            "success" => true,
            "result" => $sellPriceProduct
        ]);

        return $response;

    }

    public function viewAddProduct() {
        return view("addProduct");
    }

    public function viewAddLevelPrice() {
        return view("addLevelPriceProduct");
    }

    public function viewAddSellPriceProduct() {

        $levelPriceList = LevelPriceProduct::all();
        $productList = Product::all();

        return view("viewAddLevelPriceProduct", [
            "productList" => $productList,
            "levelPriceList" => $levelPriceList
        ]);

    }

    public function viewAddPos() {
        return view("viewAddPos");
    }

}
