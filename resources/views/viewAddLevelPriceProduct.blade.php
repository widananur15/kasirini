@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Input Harga Jual Produk</div>

                    <div class="panel-body">
                        <form action="/api/add-sell-price-product" method="post">

                            <select name="product_id">
                                @foreach($productList as $value)
                                    <option value="{{ $value->id }}">{{ $value->product_name }}</option>
                                @endforeach
                            </select>

                            <select name="level_price_id">
                                @foreach($levelPriceList as $value)
                                    <option value="{{ $value->id }}">{{ $value->level_price_name }}</option>
                                @endforeach
                            </select>

                            <input type="text" name="gross_sell_price" placeholder="Input harg jual">

                            <button class="btn-primary">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
