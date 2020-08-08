@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Input Harga Jual Produk</div>

                    <div class="panel-body">
                        <form action="/api/add-level-price-product" method="post">
                            <input type="text" name="name" placeholder="Input Harga Jual Produk">
                            <button class="btn-primary">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
