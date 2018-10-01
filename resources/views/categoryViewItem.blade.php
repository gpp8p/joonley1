<div class="categoryItem">
    <div class="companyhdr">
                        <span class="companyIcon">
                            <img src="{{$thisCategoryItem['company_icon']}}"/>
                        </span>
        <span class="companyInfo">
                            <span>{{$thisCategoryItem['company_name']}}</span>
                            <span>{{$thisCategoryItem['company_city']}}, {{$thisCategoryItem['company_state']}}</span>
                        </span>
    </div>
    <div>
        <img src="{{$thisCategoryItem['url']}}"/>
    </div>
    <div class="description">
        {{$thisCategoryItem['product_description']}}
    </div>
    <div class="ifooter">
        <span class="heart"><i class="fa fa-heart"></i></span><span class="heart"><i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i></span><span class="heart"><i class="fa fa-reply" aria-hidden="true"></i></span><span class="shop"><a href="#" onclick="showCompanyProducts({{$thisCategoryItem['company_id']}});return false;" class="but1">View Shop</a></span>
    </div>
</div>
