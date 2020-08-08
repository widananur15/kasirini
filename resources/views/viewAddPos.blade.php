@extends('layouts.app')

@section('content')
    <div class="container" ng-app="app" ng-controller="AppController">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">POS</div>

                    <div class="panel-body">

                        <select ng-model="input.product">
                            <option ng-repeat="item in productList" value="[[item.id]]">[[ item.product_name ]]</option>
                        </select>

                        <select  ng-model="input.levelPrice">
                            <option ng-repeat="item in levelPriceList" value="[[item.id]]">[[ item.level_price_name ]]</option>
                        </select>

                        <button class="btn-primary" ng-click="doSearch()">Cek Harga Produk</button><br>

                        <b>Harga Produk: [[grossSellPrice]]</b>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        angular.module("app", [])
            .config(function($interpolateProvider) {
                $interpolateProvider.startSymbol('[[');
                $interpolateProvider.endSymbol(']]');
            })
            .controller("AppController", AppController);

        AppController.$inject = ['$scope', '$http'];
        
        function AppController($scope, $http) {

            $scope.input = {};

            $scope.productList = [];
            $scope.levelPriceList = [];
            $scope.grossSellPrice = 0;

            initDataProduct();

            function initDataProduct() {

                $http.get("/api/get-product-list").then((res) => {
                    $scope.productList = res.data.result;
                });

                $http.get("/api/get-level-price-product-list").then((res) => {
                    $scope.levelPriceList = res.data.result;
                });

            }
            
            $scope.doSearch = function (){
                
                if( $scope.input.product == null ) {
                    alert("Pilih produk");
                    return;
                }
                
                if( $scope.input.levelPrice == null ) {
                    alert("Pilih harga jual");
                    return;
                }

                var input = {
                    "product_id": $scope.input.product,
                    "level_price_id": $scope.input.levelPrice
                };

                $http.post("/api/get-sell-price-product", input).then((res) => {
                    $scope.grossSellPrice = (res.data.result != null)? res.data.result.gross_sell_price : 0;
                });

            }
            
        }

    </script>

@endsection
