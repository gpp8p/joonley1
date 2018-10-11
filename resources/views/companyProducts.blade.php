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

    .scLine {
        display: grid;
        grid-template-columns: 10% 10% 40% 20% 20%;
    }
    .shopingCartWrapper{
        display: grid;
        grid-template-rows: auto;
        font-size: 12px;
        margin-left: 4px;
        visibility: hidden;
    }
    .itmHeader{
        color:red;
    }

    .sclItemq1{
        visibility: visible;
    }
    .sclItemq10{
        visibility: hidden;
    }

    .sclItem{
        visibility: visible;
    }


</style>
<script language='javascript' type='text/javascript'>

        var submitData = function(dataId){
            var selector = "[id^=opt_"+dataId+"]";
            var productElements = $(selector);
            var optionElement = "";
            var optionValueElement ="[";
            $.each(productElements, function(){
                var optionSelector = this.id;
                var thisOptionValue = $("#"+optionSelector).val();
                var thisOptionElements = thisOptionValue.split("_");
                if(thisOptionElements[0]>0){
                    optionElement+=thisOptionElements[1]+",";
                }
            });
            $.each(productElements, function(){
                var optionSelector = this.id;
                var thisOptionValue = $("#"+optionSelector).val();
                var thisOptionElements = thisOptionValue.split("_");
                if(thisOptionElements[0]>0){
                    optionValueElement+=thisOptionElements[0]+",";
                }
            });
            optionValueElement += "]";

            console.log(optionElement);
            var quantity = $("#quan_"+dataId).val();
            var q1Price = $("#priceq1_"+dataId).val();
            var q10Price = $("#priceq10_"+dataId).val();
            var thisPrice;
            var thisTotal;
            thisPrice10 = formatter.format(q10Price);
            thisTotal10 = formatter.format(q10Price*quantity);
            thisPrice1 = formatter.format(q1Price);
            thisTotal1 = formatter.format(q1Price*quantity);
            var elementIdentifier = dataId+"_"+Math.floor((Math.random() * 100) + 1);
            while($("#scl_"+elementIdentifier).length>0){
                elementIdentifier = dataId+"_"+Math.floor((Math.random() * 100) + 1);
            }
//            var thisSubval = "["+optionValueElement+","+quantity+","+q1Price+","+q10Price+","+elementIdentifier+"]";
            var thisSubvalJ = {options:optionValueElement,quan:quantity,q1P:q1Price,q10P:q10Price,elemId:elementIdentifier};

            var thisSubvalJson = JSON.stringify(thisSubvalJ);

            var thisScLine = makeScLine(optionElement, quantity, thisPrice1, thisTotal1, thisPrice10, thisTotal10, elementIdentifier, thisSubvalJson);
            console.log(thisScLine);

            var nLines = $()
            $("#scw_"+dataId).css('visibility', 'visible');
            $("#scw_"+dataId).append(thisScLine);
            adjustPrices(dataId);

        }

        var adjustPrices = function(dataId){
            var totalShoppingCartQuantity = 0;
            var cartTotalElements = $("[id^=scItemp_"+dataId+"]").each(function(index,elem){
                var thisElementIdentifier = "#subval"+elem.id.substr(7);
                var thisLineData = JSON.parse($(thisElementIdentifier).val());
                totalShoppingCartQuantity+=parseInt(thisLineData.quan);
            });
            if(totalShoppingCartQuantity>9){
                $("[id^=scItemp_"+dataId+"]").each(function(index,elem){
                    var thisElementIdentifier = "#subval"+elem.id.substr(7);
                    var thisLineData = JSON.parse($(thisElementIdentifier).val());
                    elem.innerText = formatter.format(thisLineData.q10P);
                });
                $("[id^=scItemt_"+dataId+"]").each(function(index,elem){
                    var thisElementIdentifier = "#subval"+elem.id.substr(7);
                    var thisLineData = JSON.parse($(thisElementIdentifier).val());
                    var thisPrice = thisLineData.q10P
                    var thisQuan = parseInt(thisLineData.quan);
                    elem.innerText = formatter.format(thisQuan*thisPrice);
                });
            }else{
                $("[id^=scItemp_"+dataId+"]").each(function(index,elem){
                    var thisElementIdentifier = "#subval"+elem.id.substr(7);
                    var thisLineData = JSON.parse($(thisElementIdentifier).val());
                    elem.innerText = formatter.format(thisLineData.q1P);
                });
                $("[id^=scItemt_"+dataId+"]").each(function(index,elem){
                    var thisElementIdentifier = "#subval"+elem.id.substr(7);
                    var thisLineData = JSON.parse($(thisElementIdentifier).val());
                    var thisPrice = thisLineData.q1P
                    var thisQuan = parseInt(thisLineData.quan);
                    elem.innerText = formatter.format(thisQuan*thisPrice);
                });
            }
        }

        var makeScLine = function(optionElement, quantity, thisPrice1, thisTotal1, thisPrice10, thisTotal10,elemId, subVal){
            var strVar="";
            strVar += "        <div id=\"scl_"+elemId+"\" class=\"scLine\">";
            strVar += "            <span>";
            strVar += "                <i class=\"fa fa-window-close\" id=\"delScl_"+elemId+"\" onclick=\"removeScLine(this);return false;\" aria-hidden=\"true\"><\/i>";
            strVar += "            <\/span>";
            strVar += "            <span class=\"sclItem\">";
            strVar += quantity;
            strVar += "            <\/span>";
            strVar += "            <span class=\"sclItem\">";
            strVar += optionElement;
            strVar += "            <\/span>";

            strVar += "            <span id=\"scItemp_"+elemId+"\" class=\"sclItem\">";
            strVar += thisPrice1;
            strVar += "            <\/span>";
            strVar += "            <span id=\"scItemt_"+elemId+"\" class=\"sclItem\">";
            strVar += thisTotal1;
            strVar += "            <\/span>";

            strVar += " <input type='hidden' id='subval_"+elemId+"' name='subval_"+elemId+"' value='"+subVal+"' \/>";
            strVar += "        <\/div>";
            strVar += "";
            return strVar;

        }
        var removeScLine = function(elem){
            var elementToRemove = "#scl" + elem.id.substring(6);
            $(elementToRemove).remove();
            thisDataId = elem.id.split("_")[1];
            adjustPrices(thisDataId);

        }

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2,
            // the default value for minimumFractionDigits depends on the currency
            // and is usually already 2
        });



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