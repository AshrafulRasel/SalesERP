@extends('layouts.master')

@section('title', 'Invoice | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Form Samples</h1>
                <p>Sample forms</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item"><a href="#">Sample Forms</a></li>
            </ul>
        </div>


        <div class="row">
            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Invoice</h3>
                    <div class="tile-body">
                        <form  method="POST" action="{{route('invoice.update',$invoice->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-3">
                                <label class="control-label">Customer Name</label>
                                <select name="customer_id" class="form-control">
                                    <option name="customer_id" value="{{$invoice->customer->id}}">{{$invoice->customer->name}}</option>
                                    @foreach($customers as $customer)
                                        <option name="customer_id" value="{{$customer->id}}">{{$customer->name}} </option>
                                    @endforeach
                                </select>                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Date</label>
                                <input name="date"  class="form-control datepicker"  value="<?php echo date('Y-m-d')?>" type="date" placeholder="Enter your email">
                            </div>



                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col"><a class="addRow"><i class="fa fa-plus"></i></a></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sales as $sale)
                                 <tr>
                                    <td><select name="product_id[]" class="form-control productname" >
                                            <option name="product_id[]" value="{{$sale->product->id}}">{{$sale->product->name}}</option>
                                            @foreach($products as $product)
                                                <option name="product_id[]" value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select></td>
                                    <td><input value="{{$sale->qty}}" type="text" name="qty[]" class="form-control qty" ></td>
                                    <td><input value="{{$sale->price}}" type="text" name="price[]" class="form-control price" ></td>
                                    <td><input value="{{$sale->dis}}" type="text" name="dis[]" class="form-control dis" ></td>
                                    <td><input value="{{$sale->amount}}" type="text" name="amount[]" class="form-control amount" ></td>
                                    <td><a   class="btn btn-danger remove"> <i class="fa fa-remove"></i></a></td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total</b></td>
                                    <td><b class="total"></b></td>
                                    <td></td>
                                </tr>
                                </tfoot>

                            </table>

                            <div >
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>







    </main>

@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="{{asset('/')}}js/multifield/jquery.multifield.min.js"></script>




    <script type="text/javascript">
        $(document).ready(function(){



            $('tbody').delegate('.productname', 'change', function () {

                var  tr = $(this).parent().parent();
                tr.find('.qty').focus();

            })

            $('tbody').delegate('.productname', 'change', function () {

                var tr =$(this).parent().parent();
                var id = tr.find('.productname').val();
                var dataId = {'id':id};
                $.ajax({
                    type    : 'GET',
                    url     :'{!! URL::route('findPrice') !!}',

                    dataType: 'json',
                    data: {"_token": $('meta[name="csrf-token"]').attr('content'), 'id':id},
                    success:function (data) {
                        tr.find('.price').val(data.sales_price);
                    }
                });
            });

            $('tbody').delegate('.qty,.price,.dis', 'keyup', function () {

                var tr = $(this).parent().parent();
                var qty = tr.find('.qty').val();
                var price = tr.find('.price').val();
                var dis = tr.find('.dis').val();
                var amount = (qty * price)-(qty * price * dis)/100;
                tr.find('.amount').val(amount);
                total();
            });
            function total(){
                var total = 0;
                $('.amount').each(function (i,e) {
                    var amount =$(this).val()-0;
                    total += amount;
                })
                $('.total').html(total);
            }

            $('.addRow').on('click', function () {
                addRow();

            });

            function addRow() {
                var addRow = '<tr>\n' +
                    '         <td><select name="product_id[]" class="form-control productname " >\n' +
                    '         <option value="0" selected="true" disabled="true">Select Product</option>\n' +
                    '                                        @foreach($products as $product)\n' +
                    '                                            <option value="{{$product->id}}">{{$product->name}}</option>\n' +
                    '                                        @endforeach\n' +
                    '               </select></td>\n' +
                    '                                <td><input type="text" name="qty[]" class="form-control qty" ></td>\n' +
                    '                                <td><input type="text" name="price[]" class="form-control price" ></td>\n' +
                    '                                <td><input type="text" name="dis[]" class="form-control dis" ></td>\n' +
                    '                                <td><input type="text" name="amount[]" class="form-control amount" ></td>\n' +
                    '                                <td><a   class="btn btn-danger remove"> <i class="fa fa-remove"></i></a></td>\n' +
                    '                             </tr>';
                $('tbody').append(addRow);
            };


            $('.remove').live('click', function () {
                var l =$('tbody tr').length;
                if(l==1){
                    alert('you cant delete last one')
                }else{

                    $(this).parent().parent().remove();

                }

            });
        });


    </script>

@endpush



