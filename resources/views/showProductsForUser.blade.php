<style>
.fillFrame{
    background-color: #eeeeee;
    height:100%;
    width:100%;
}
.productGrid {
    display: grid;
    grid-template-columns: 25% 75%;
    margin-left: 10px;
    padding-top: 10px;

}
.productRow{
    display:grid;
    grid-template-rows: 95% 5%;
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
hr {
    border-top: 1px dashed #8c8b8b;
}
.btnsize {
    height:30px;
}

.imageRow{
    display: grid;
    grid-gap: 10px 15px;

    grid-template-columns: repeat(3, 1fr 1fr);
}

</style>

<script language='javascript' type='text/javascript'>

</script>
<div class="fillFrame">

        @foreach($thisUsersProducts as $thisProduct)

            <div class="productRow">
                <div class="productGrid">
                    <div class="product">
                        <div class="productItem"><span class="plabel">Product Name:  </span>{{$thisProduct['product_name']}}</div>
                        <div class="productItem"><span class="plabel">Category:  </span>{{$thisProduct['category_name']}}</div>
                        <div class="productItem"><span class="plabel">Price (q1):  </span>{{$thisProduct['price_q1']}}</div>
                        <div class="productItem"><span class="plabel">Price (q10):  </span>{{$thisProduct['price_q10']}}</div>
                        <div class="productItem"><span class="plabel">When Added:  </span>{{$thisProduct['created_at']}}</div>
                    </div>
                    <div class="imageRow">
                        @if(sizeof($thisProduct['product_images'])<4)
                            @foreach($thisProduct['product_images'] as $thisProductImage)
                                <div class="productImage">
                                    <img src="{{$thisProductImage}}" />
                                </div>
                            @endforeach
                            <form method="get" action="{{url('/showOneProduct')}}?id={{$thisProduct['product_id']}}">
                                <button class="btn btnsize">More</button>
                            </form>
                        @else
                            @for($i=0;$i<4;$i++)
                                <div class="productImage">
                                    <img src="{{$thisProduct['product_images'][$i]}}" />
                                </div>
                            @endfor
                                <form method="get" action="{{url('/showOneProduct')}}?id={{$thisProduct['product_id']}}">
                                    <button class="btn btnsize">More->></button>
                                </form>
                        @endif
                    </div>
                </div>
                <div>
                    <hr/>
                </div>
            </div>

    @endforeach
</div>