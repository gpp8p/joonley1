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

    .categoryItem{
        border-radius: 10px;
        background-color: rgba(0, 255, 248, 0.2);
        border-style: solid;
        border-width: 1px;
        border-color: #6610f2;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-top: 4px;
        margin-bottom: 4px;

    }

    .categoryTitle{
        font-family: 'Fira Sans Condensed', sans-serif;
        color:black;
        font-size: 24px;
        margin-left: 40%;
        padding-top: 5px;
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

    .productName{
        color:black;
        text-align: center;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 14px;
        width:90%;

    }
    .productDetail{
        display:grid;
        grid-template-columns: 50% 50%;
    }
    .productPrices{
        display:grid;
        grid-template-rows: auto;
    }
    .price{
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 14px;
        color:black;
        margin-left: 4px;
        height: 20px;

    }
    .quantitySelect{
        margin-top: 10px;
    }
    .optionsArea {
        display:grid;
        grid-template-rows: 30%;
        grid-row-gap: 0;
        margin-left: 5px;
    }
    .optionSelect{


    }
    select{
        width: 90%;
        height: 20%;
    }
    .orderArea {
        display:grid;
        grid-template-rows: 20px;
    }

    .optionTitle {
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 14px;
        color:black
    }

    .companyhdr {
        display:grid;
        grid-template-columns: 15% 85%;
        color:black;
        text-align: left;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 10px;
        width:90%;

    }

    .companyIcon{

    }
    .companyInfo {
        display:grid;
        grid-template-rows: auto;
    }
    .name{
        color:black;
        text-align: center;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 14px;

    }


    .ifooter{
        margin-left: 25%;
        margin-right: 5%;

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
        padding:2px 12px;
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
    img{
        height:90%;
        width:90%;
    }


</style>
<script language='javascript' type='text/javascript'>

        var submitData = function(dataId){
            var selector = "[id^=opt_"+dataId+"]";
            var productElements = $(selector);
            for(i=0;i<productElements.length;i++){
                var thisVal = productElements[i];
            }
        }


</script>
<div class="fillFrame">
    @foreach($categoryKeys as $thisCategoryKey)
        @php
            $companyProducts = $categoryCompanyProducts[$thisCategoryKey];
        @endphp
        <div class="categoryTitle">
            {{$thisCategoryKey}}
        </div>

        <div class="feedWrapper">
            <div class="col1">
                @foreach($companyProducts['col1'] as $thisCompanyItem)
                    @include('individualCompanyProduct')
                @endforeach
            </div>
            <div class="col2">
                @foreach($companyProducts['col2'] as $thisCompanyItem)
                    @include('individualCompanyProduct')
                @endforeach
            </div>
            <div class="col3">
                @foreach($companyProducts['col3'] as $thisCompanyItem)
                    @include('individualCompanyProduct')
                @endforeach
            </div>
            <div class="col4">
                @foreach($companyProducts['col4'] as $thisCompanyItem)
                    @include('individualCompanyProduct')
                @endforeach
            </div>
        </div>
    @endforeach
</div>