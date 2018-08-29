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
        margin-left: 15px;
    }
    .plabel {
        color: #0000ff;
    }

    .productItem {
        font-size: 12px;
        color:black;
        font-family: 'Fira Sans Condensed', sans-serif;
    }

    .font18 {
        font-size: 18px;
    }
    .imageRow{
        display: grid;
        grid-gap: 10px 15px;

        grid-template-columns: repeat(3, 1fr 1fr);
        margin-left: 15px;
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
        <div class="productItem font18"><span class="plabel">Product Name:  </span>{{$thisProduct['product_name']}}</div>
        <div class="productItem font18"><span class="plabel">Category:  </span>{{$thisProduct['category_name']}}</div>
        <div class="productItem font18"><span class="plabel">Price (q1):  </span>{{$thisProduct['price_q1']}}</div>
        <div class="productItem font18"><span class="plabel">Price (q10):  </span>{{$thisProduct['price_q10']}}</div>
        <div class="productItem font18"><span class="plabel">When Added:  </span>{{$thisProduct['created_at']}}</div>
        <div class="productItem font18"><span class="plabel">Ship Weight:  </span>{{$thisProduct['ship_weight']}} Lbs. {{$thisProduct['ship_weight_oz']}} Oz.</div>
        <div class="productItem font18"><span class="plabel">Produced By:  </span>{{$thisProduct['whomade']}}</div>
        <div class="productItem font18"><span class="plabel">Item Is:  </span>{{$thisProduct['prodis']}}</div>
    </div>
    <div class="imageRow">
        @foreach($thisProduct['product_images'] as $thisProductImage)
            <div class="productImage">
                <img src="{{$thisProductImage}}" />
            </div>
        @endforeach

    </div>
</div>

