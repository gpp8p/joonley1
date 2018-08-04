<div class="iconmenu">
    @if($adminView)
        <div class="oneicon" onclick="event.preventDefault(); document.getElementById('feed-form').submit();">
            <i class="fa fa-cogs" aria-hidden="true"></i>
            <div>Admin</div>
        </div>
    @endif
    <div class="oneicon" onclick="event.preventDefault(); document.getElementById('feed-form').submit();">
        <i class="fa fa-newspaper fa-1x" aria-hidden="true"></i>
        <div>Feed</div>
    </div>
    <div class="oneicon" onclick="event.preventDefault(); document.getElementById('order-form').submit();">
        <i class="fas fa-dollar-sign" aria-hidden="true"></i>
        <div>Orders</div>
    </div>
    <div class="oneicon" onclick="event.preventDefault(); document.getElementById('specials-form').submit();">
        <i class="fa fa-exclamation-circle fa-1x" aria-hidden="true"></i>
        <div>Specials</div>
    </div>
    <div class="oneicon" onclick="event.preventDefault(); document.getElementById('favorites-form').submit();">
        <i class="fas fa-heart" aria-hidden="true"></i>
        <div>Favorites</div>
    </div>
    <div class="oneicon" onclick="event.preventDefault(); document.getElementById('search-form').submit();">
        <i class="fa fa-search fa-1x" aria-hidden="true"></i>
        <div>Search</div>
    </div>
    <div class="oneicon" onclick="event.preventDefault(); document.getElementById('messages-form').submit();">
        <i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i>
        <div>Messages</div>
    </div>
    <div class="oneicon" onclick="event.preventDefault(); document.getElementById('more-form').submit();">
        <i class="fa fa-ellipsis-h fa-1x" aria-hidden="true"></i>
        <div>More</div>
    </div>
    <div class="oneicon" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt 1x" aria-hidden="true"></i>
        <div>Logout</div>
    </div>
</div>
