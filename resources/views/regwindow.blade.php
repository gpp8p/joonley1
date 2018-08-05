@foreach ($outstandingRegistrations as $thisRegistration)
    <div class="regrow" id="{{$thisRegistration->id}}" onclick="getOneRegistrationRequest(this);">
        <div class="regcol">{{$thisRegistration->email}}</div>
        <div class="regcol">{{$thisRegistration->fname}}</div>
        <div class="regcol">{{$thisRegistration->lname}}</div>
    </div>
@endforeach
