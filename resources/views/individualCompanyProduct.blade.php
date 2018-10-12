<div class="categoryItem">
    <div class="companyhdr">

    </div>
    <div>
        <img src="{{$thisCompanyItem->getImageUrl()}}"/>
    </div>
    <div class="productName">
        {{$thisCompanyItem->getName()}}
    </div>
    <div class="productDetail">
        <div class="optionsArea">
            @php
                $thisProductOptions = $thisCompanyItem->getOptionTypes();
            @endphp
            @foreach($thisProductOptions as $thisOptionType)
                @if($thisOptionType->getName() !='null')
                    @php
                        $thisOptions = $thisOptionType->getOptions();
                    @endphp
                    <span class="optionSelect">
                        <select id="opt_{{$thisCompanyItem->getId()}}_{{$thisOptionType->getId()}}">
                            <option value="0" selected >Please select: {{$thisOptionType->getName()}}</option>
                            @foreach($thisOptions as $thisOpt)
                                <option value="{{$thisOpt->getId()}}_{{$thisOpt->getValue()}}">{{$thisOpt->getValue()}}</option>
                            @endforeach
                        </select>
                    </span>
                @endif
            @endforeach
        </div>
        <div class="orderArea">
            <span class="productPrices">
                <div class="price">
                    q1 price: ${{$thisCompanyItem->getPriceQ1()}}
                    <input type="hidden" value="{{$thisCompanyItem->getPriceQ1()}}" id="priceq1_{{$thisCompanyItem->getId()}}" />
                </div>

                <div class="price">
                    q10 price  ${{$thisCompanyItem->getPriceQ10()}}
                    <input type="hidden" value="{{$thisCompanyItem->getPriceQ10()}}" id="priceq10_{{$thisCompanyItem->getId()}}" />
                </div>
            </span>
            <span class="quantitySelect">
                <select id ="quan_{{$thisCompanyItem->getId()}}">
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
        <span class="shop">
            <a href="#"  class="but1">Details</a>
        </span>
        <span class="shop">
            <a href="#"  onclick="submitData({{$thisCompanyItem->getId()}});return false;" class="but1">Add to Cart</a>
        </span>
    </div>
    <div class="shopingCartWrapper" id="scw_{{$thisCompanyItem->getId()}}">
        <span class="scLine">
        <span class="itmHeader">Del</span>
        <span class="itmHeader">Quan.</span>
        <span class="itmHeader">Options</span>
        <span class="itmHeader">Price Ea.</span>
        <span class="itmHeader">Total</span>
        </span>

    </div>
</div>
