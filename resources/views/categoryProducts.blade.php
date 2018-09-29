<style>
    .fillFrame{
        background-color: #eeeeee;
        height:100%;
        width:100%;
    }

    .feedWrapper{
        display: grid;
        grid-template-columns: 25% 25% 25% 25%;
        grid-template-areas: "col1 col2 col3 col4";
    }

    .col1{
        font-family: 'Fira Sans Condensed', sans-serif;
        color:black;
        padding-left: 2px;
        padding-right: 2px;
    }

    .col2{
        font-family: 'Fira Sans Condensed', sans-serif;
        color:black;
        padding-left: 2px;
        padding-right: 2px;

    }

    .col3{
        font-family: 'Fira Sans Condensed', sans-serif;
        color:black;
        padding-left: 2px;
        padding-right: 2px;

    }

    .col4{
        font-family: 'Fira Sans Condensed', sans-serif;
        color:black;
        padding-left: 2px;
        padding-right: 2px;

    }

    .feedItem{
        border-radius: 10px;
        border-color: #ff070f;
        border-style: solid;
        border-width: 1px;
        margin-top: 3px;

    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5px;
        align-self: center;

    }
    .description{
        color:black;
        text-align: center;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 10px;
        width:90%;
    }

    .companyInfo {
        color:black;
        text-align: left;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 10px;
        width:90%;

    }

    .name{
        color:black;
        text-align: center;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 14px;

    }


    .ifooter{
        margin-left: 5%;
        margin-right: 5%;
        padding-top: 15px;

    }

    .heart{
        color: #5262ff;
        margin-right: 15px;
        vertical-align: bottom;
    }
    .shop{
        vertical-align: top;
    }

    .but1 {
        -moz-box-shadow:inset 0px 1px 0px 0px #97c4fe;
        -webkit-box-shadow:inset 0px 1px 0px 0px #97c4fe;
        box-shadow:inset 0px 1px 0px 0px #97c4fe;
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #3d94f6), color-stop(1, #1e62d0));
        background:-moz-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
        background:-webkit-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
        background:-o-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
        background:-ms-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
        background:linear-gradient(to bottom, #3d94f6 5%, #1e62d0 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3d94f6', endColorstr='#1e62d0',GradientType=0);
        background-color:#3d94f6;
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;
        border:1px solid #337fed;
        display:inline-block;
        cursor:pointer;
        color:#ffffff;
        font-family:Arial;
        font-size:12px;
        font-weight:bold;
        padding:6px 16px;
        text-decoration:none;
        text-shadow:0px 1px 0px #1570cd;
    }
    .but1:hover {
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #1e62d0), color-stop(1, #3d94f6));
        background:-moz-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
        background:-webkit-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
        background:-o-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
        background:-ms-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
        background:linear-gradient(to bottom, #1e62d0 5%, #3d94f6 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0', endColorstr='#3d94f6',GradientType=0);
        background-color:#1e62d0;
    }


</style>

<script language='javascript' type='text/javascript'>


</script>


<div class="fillFrame">
    <div class="feedWrapper">
        <div class="col1">
            @foreach($thisCategoryProducts['col1'] as $thisCategoryItem)
                <div class="feedItem">
                    <div class="name">
                        {{$thisCategoryItem['product_name']}}
                    </div>
                    <div>
                        <img src="{{$thisCategoryItem['url']}}"/>
                    </div>
                    <div class="description">
                        {{$thisCategoryItem['product_description']}}
                    </div>
                    <div class="ifooter">
                        <span class="heart"><i class="fa fa-heart"></i></span><span class="heart"><i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i></span><span class="heart"><i class="fa fa-reply" aria-hidden="true"></i></span><span class="shop"><a href="#" class="but1">View Shop</a></span>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="col2">
            @foreach($thisCategoryProducts['col2'] as $thisCategoryItem)
                <div class="feedItem">
                    <div class="name">
                        {{$thisCategoryItem['product_name']}}
                    </div>
                    <div>
                        <img src="{{$thisCategoryItem['url']}}"/>
                    </div>
                    <div class="description">
                        {{$thisCategoryItem['product_description']}}
                    </div>
                    <div class="ifooter">
                        <span class="heart"><i class="fa fa-heart"></i></span><span class="heart"><i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i></span><span class="heart"><i class="fa fa-reply" aria-hidden="true"></i></span><span class="shop"><a href="#" class="but1">View Shop</a></span>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="col3">
            @foreach($thisCategoryProducts['col3'] as $thisCategoryItem)
                <div class="feedItem">
                    <div class="name">
                        {{$thisCategoryItem['product_name']}}
                    </div>
                    <div>
                        <img src="{{$thisCategoryItem['url']}}"/>
                    </div>
                    <div class="description">
                        {{$thisCategoryItem['product_description']}}
                    </div>
                    <div class="ifooter">
                        <span class="heart"><i class="fa fa-heart"></i></span><span class="heart"><i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i></span><span class="heart"><i class="fa fa-reply" aria-hidden="true"></i></span><span class="shop"><a href="#" class="but1">View Shop</a></span>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="col4">
            @foreach($thisCategoryProducts['col4'] as $thisCategoryItem)
                <div class="feedItem">
                    <div class="name">
                        {{$thisCategoryItem['product_name']}}
                    </div>
                    <div>
                        <img src="{{$thisCategoryItem['url']}}"/>
                    </div>
                    <div class="description">
                        {{$thisCategoryItem['product_description']}}
                    </div>
                    <div class="ifooter">
                        <span class="heart"><i class="fa fa-heart"></i></span><span class="heart"><i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i></span><span class="heart"><i class="fa fa-reply" aria-hidden="true"></i></span><span class="shop"><a href="#" class="but1">View Shop</a></span>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>