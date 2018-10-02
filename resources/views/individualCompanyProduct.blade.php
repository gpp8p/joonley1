<div class="categoryItem">
    <div class="companyhdr">

    </div>
    <div>
        <img src="{{$thisCompanyItem[2]}}"/>
    </div>
    <div class="productName">
        {{$thisCompanyItem[0]}}
    </div>
    <div class="productDetail">
        <div class="optionsArea">
            @php
                $thisProductOptions = $thisCompanyItem[1];
                $thisOptionKeys = array_keys($thisProductOptions);
            @endphp
            @foreach($thisOptionKeys as $thisKey)
                @php
                    $thisOptions = $thisProductOptions[$thisKey];
                @endphp
                <span class="optionSelect">
                    <select >
                        <option value="0" selected >Please select: {{$thisKey}}</option>
                        @foreach($thisOptions as $thisOpt)
                            <option value="{{$thisOpt}}">{{$thisOpt}}</option>
                        @endforeach
                    </select>
                </span>
            @endforeach
        </div>
        <div class="orderArea">
            <span class="productPrices">
                <span class="price">
                    q1 - $xxx.xxx
                </span>
                <span class="price">
                    q10 - $xxx.xxx
                </span>
            </span>
            <span class="quantitySelect">
                <select>
                    <option value="0" selected >Select Quantity</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>

                </select>
            </span>

        </div>
    </div>
    <div class="ifooter">
        <span class="heart"><i class="fa fa-heart"></i></span><span class="heart"><i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i></span><span class="heart"><i class="fa fa-reply" aria-hidden="true"></i></span><span class="shop"><a href="#"  class="but1">Info</a></span><span class="shop" style="margin-left: 4px;"><a href="#"  class="but1">Add to Cart</a></span>
    </div>
</div>
