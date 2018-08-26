<style>
.fillFrame{
    background-color: #eeeeee;
    height:100%;
    width:100%;
}
.productGrid {
    display: grid;
    grid-template-columns: 35% 15% 15% 15% 30%;

}

.productItem {
    font-size: 15px;
    color:black;
    font-family: 'Fira Sans Condensed', sans-serif;
}

</style>

<script language='javascript' type='text/javascript'>

</script>
<div class="fillFrame">
    <div class="productGrid">
        @foreach($thisUsersProducts as $thisProduct)
            <div class="productItem">{{$thisProduct->product_name}}</div>
            <div class="productItem">{{$thisProduct->category_name}}</div>
            <div class="productItem">{{$thisProduct-> price_q1}}</div>
            <div class="productItem">{{$thisProduct-> price_q10}}</div>
            <div class="productItem">{{$thisProduct-> created_at}}</div>
        @endforeach

    </div>

</div>