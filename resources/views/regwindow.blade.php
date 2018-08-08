<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<style>
    /* registrations list styling */
    .registrations{
        display: grid;
        grid-template-rows:90% 10%;
        height: calc(80vh - 30px);
        background-color: #eeeeee;
    }
    .regtable{
        margin-left: 10px;
        margin-right: 10px;
        font-size: 125%;
        display:grid;
        grid-template-rows: repeat(auto-fill, minmax(30px,1fr));
        background-color: #eeeeee;
    }
    .regheader {
        color: #484848;
        background-color: #eeeeee;
        display:grid;
        grid-template-columns: 50% 25% 25%;
    }
    .regrow {
        display: grid;
        grid-template-columns: 50% 25% 25%;
        color:blue;
    }
    .regrow:hover{
        color:red;
    }
    .regcol {
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size:100%;
    }

    .registrationPager {
        display:grid;
        grid-template-columns:70% 30%
    }
</style>
<script language='javascript' type='text/javascript'>
    var getOneRegistrationRequest = function(clickedElement){
        window.location.replace('{{route('showRegistration')}}?regId='+clickedElement.id);
    }
</script>
<div class="registrations">
    <div class="regtable">
        <div class="regheader">
            <div>Email</div>
            <div>First Name</div>
            <div>Last Name</div>
        </div>
        @foreach ($outstandingRegistrations as $thisRegistration)
            <div class="regrow" id="{{$thisRegistration->id}}" onclick="getOneRegistrationRequest(this);">
                <div class="regcol">{{$thisRegistration->email}}</div>
                <div class="regcol">{{$thisRegistration->fname}}</div>
                <div class="regcol">{{$thisRegistration->lname}}</div>
            </div>
        @endforeach
    </div>
    <div class="registrationPager">
        <div></div>
        <div>
            {{ $outstandingRegistrations->links() }}
        </div>
    </div>
</div>
