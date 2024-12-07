@extends('layout')
@section('content')
<div class="row">
    <div class="row align-items-stretch">
        <div class="c-dashboardInfo col-lg-3 col-md-6">
            <div class="wrap">
            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Total Products
            </h4><span class="hind-font caption-12 c-dashboardInfo__count">{{$products}}</span>
            </div>
        </div>
        <div class="c-dashboardInfo col-lg-3 col-md-6">
            <div class="wrap">
            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Products Out of Stock
            </h4><span class="hind-font caption-12 c-dashboardInfo__count">{{$out_of_stock}}</span>
            </div>
        </div>
        <div class="c-dashboardInfo col-lg-3 col-md-6">
            <div class="wrap">
            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Total Users
            </h4><span class="hind-font caption-12 c-dashboardInfo__count">{{$users}}</span>
            </div>
        </div>
        <div class="c-dashboardInfo col-lg-3 col-md-6">
            <div class="wrap">
            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Products Added Today
            </h4><span class="hind-font caption-12 c-dashboardInfo__count">{{$today_added}}</span>
            </div>
        </div>
    </div>  
</div>

<script>
    $(document).ready(function(){
        $('.dashboard').css('backgroundColor','#0059b3');
    });
</script>
@endsection