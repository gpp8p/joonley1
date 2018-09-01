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
        max-height: 100%;
        max-width: 100%;
        align-self: center;
    }
    .productImage{
        display: grid;
        grid-template-rows: 90% 10%;

    }
    .feedSelect{
        font-size: 12px;
        color:black;
        font-family: 'Fira Sans Condensed', sans-serif;
        align-self: center;
    }
    .feedLabel{
        margin-left: 3px;
    }
</style>

<script language='javascript' type='text/javascript'>

</script>

<div class="fillFrame">

    <div class="product font18">
        <div class="productItem"><span class="plabel">Product Name:  </span>{{$thisProduct['product_name']}}</div>
        <div class="productItem"><span class="plabel">Product Description:  </span>{{$thisProduct['product_description']}}</div>
        <div class="productItem"><span class="plabel">Category:  </span>{{$thisProduct['category_name']}}</div>
        <div class="productItem"><span class="plabel">Catalog:  </span>{{$thisProduct['product_collection_name']}}</div>
        <div class="productItem"><span class="plabel">Price (q1):  </span>{{$thisProduct['price_q1']}}</div>
        <div class="productItem"><span class="plabel">Price (q10):  </span>{{$thisProduct['price_q10']}}</div>
        <div class="productItem"><span class="plabel">When Added:  </span>{{$thisProduct['created_at']}}</div>
        <div class="productItem"><span class="plabel">Ship Weight:  </span>{{$thisProduct['ship_weight']}} Lbs. {{$thisProduct['ship_weight_oz']}} Oz.</div>
        <div class="productItem"><span class="plabel">Produced By:  </span>{{$thisProduct['whomade']}}</div>
        <div class="productItem"><span class="plabel">Item Is:  </span>{{$thisProduct['prodis']}}</div>
    </div>

    @php
        $i = 0;
        $j=0;
    @endphp
<form method="POST" action="{{ url('/feedPreview') }}">
    {{ csrf_field() }}
    @while($i<count($thisProduct['product_images']))
        <div class="imageRow">
            @while($j<5 && $i<count($thisProduct['product_images']))

                <div class="productImage">
                    <img src="{{$thisProduct['product_images'][$i]}}" />
                    <span class="feedSelect">
                        @if($i==0)
                            <input type="radio" name="feedSelect" value="feed{{$thisProduct['product_imageids'][$i]}}" checked="checked" />
                        @else
                            <input type="radio" name="feedSelect" value="feed{{$thisProduct['product_imageids'][$i]}}"/>
                        @endif
                        <span class="feedLabel">Select Feed Image</span>
                    </span>

                    @php
                        $i++;
                        $j++;
                    @endphp
                </div>

            @endwhile
            @php
                $j=0;
            @endphp`

        </div>
    @endwhile
    <button class="btn"/>Select This Product for Feed</button>
    <input type="hidden" name="product_id" value="{{$thisProduct['product_id']}}"/>
    <input type="hidden" name="collection_id" value="{{$thisProduct['product_collection_id']}}"/>

</form>


</div>

