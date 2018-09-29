@extends('layouts.jheader')

@section('content')
    <div class="wrapper">
        <div class="box header">
            <div class="joonleyTitle">Joonley</div>
            <div class="menuicons">
                <div></div>
                <div>
                    @include('iconmenu')
                </div>
            </div>
        </div>
        <div class="bar"></div>
        <div id="sidebar" class="sidebar">
            @switch($sidebar)
                @case('admin')
                    @include('adminSidebar')
                @break
                @case('feed')
                    @include('feedSidebar')
                @break
                @case('orders')
                    @include('ordersSidebar')
                @break
                @case('specials')
                    @include('specialsSidebar')
                @break
                @case('favorites')
                    @include('favoritesSidebar')
                @break
                @case('search')
                    @include('searchSidebar')
                @break
                @case('messages')
                    @include('messagesSidebar')
                @break
                @case('more')
                    @include('moreSidebar')
                @break
                @case('products')
                    @if($adminView)
                        @include('productsSidebarAdmin')
                    @elseif(Auth::user()->buysell_type == 'B')
                        @include('productsSidebarBuyer')
                    @else
                        @include('productsSidebar')
                    @endif
                @break


            @endswitch
        </div>
        <div class="box content">
            @switch($contentWindow)
                @case('viewRegistrations')
                    @include('regwindow')
                @break
                @case('viewThisRegistration')
                    @include('regdata')
                @break
                @case('feedContent')
                    @include('feed')
                @break
                @case('ordersContent')
                    @include('ordersContent')
                @break
                @case('specialsContent')
                    @include('specialsContent')
                @break
                @case('favoritesContent')
                    @include('favoritesContent')
                @break
                @case('searchContent')
                    @include('searchContent')
                @break
                @case('messagesContent')
                    @include('messagesContent')
                @break
                @case('moreContent')
                    @include('moreContent')
                @break
                @case('productsContent')
                    @include('productsContent')
                @break
                @case('newProductsContent')
                    @include('productEntry')
                @break
                @case('productsForUser')
                    @include('showProductsForUser')
                @break
                @case('oneProduct')
                    @include('oneProduct')
                @break
                @case('feedPreview')
                    @include('feedPreview')
                @break
                @case('viewUsers')
                    @include('allUserList')
                @break
                @case('userEdit')
                    @include('userEdit')
                @break
                @case('companyEdit')
                    @include('companyEdit')
                @break
                @case('buyerProductsView')
                    @include('buyerViewSeller')
                @break
                @case('createCategories')
                    @include('createCategory')
                @break
                @case('categoryProducts')
                    @include('categoryProducts')
                @break


            @endswitch
        </div>

@endsection