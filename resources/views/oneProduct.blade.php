<style>
    .fillFrame{
        background-color: #eeeeee;
        height:100%;
        width:100%;
    }
    .product{
        display: grid;
        grid-template-rows: auto;
        margin-bottom: 8px;
    }
    .plabel {
        color: #0000ff;
    }

    .productItem {
        font-size: 12px;
        color:black;
        font-family: 'Fira Sans Condensed', sans-serif;
    }

    img {
        max-height: 75%;
        max-width: 75%;
    }
</style>

<script language='javascript' type='text/javascript'>

</script>

<div class="fillFrame">

    <div class="product">
        <div class="productItem"><span class="plabel">Product Name:  </span>{{$thisProduct['product_name']}}</div>
        <div class="productItem"><span class="plabel">Category:  </span>{{$thisProduct['category_name']}}</div>
        <div class="productItem"><span class="plabel">Price (q1):  </span>{{$thisProduct['price_q1']}}</div>
        <div class="productItem"><span class="plabel">Price (q10):  </span>{{$thisProduct['price_q10']}}</div>
        <div class="productItem"><span class="plabel">When Added:  </span>{{$thisProduct['created_at']}}</div>
    </div>
</div>

