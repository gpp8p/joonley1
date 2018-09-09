<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<style>
    /* registrations list styling */
    .fillFrame{
        background-color: #eeeeee;
        height:100%;
        width:100%;
    }
    .registrations{
        display: grid;
        grid-template-rows:90% 10%;
        height: calc(80vh - 30px);
        background-color: #eeeeee;
    }
    .regtable{
        margin-left: 3px;
        margin-right: 3px;
        display:grid;
        grid-template-rows: 30px 90%;
        background-color: #eeeeee;
    }
    .regheader {
        display:grid;
        grid-template-columns: 50% 25% 25%;
        align-items: center;
        color: #ffffff;
        background-color: #9d9d9d;

    }
    .regrow {
        display: grid;
        grid-template-columns: 50% 25% 25%;
        color:black;
    }
    .regrow:hover{
        background-color: #07eefa;
    }
    .regcol {
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size:16px;
    }
    .registrationPager {
        display:grid;
        grid-template-columns:70% 30%
    }
    .regBody{
        margin-top: 5px;
    }
</style>
<script language='javascript' type='text/javascript'>
    var getOneRegistrationRequest = function(clickedElement){
        window.location.replace('{{route('showRegistration')}}?regId='+clickedElement.id);
    }
</script>
<div class="fillFrame">
    <div class="registrations">
        <div class="regtable">
            <div class="regheader">
                <div>Email</div>
                <div>First Name</div>
                <div>Last Name</div>
            </div>
            <div class="regBody">
                @foreach ($outstandingRegistrations as $thisRegistration)
                    <div class="regrow" id="{{$thisRegistration->id}}" onclick="getOneRegistrationRequest(this);">
                        <div class="regcol">{{$thisRegistration->email}}</div>
                        <div class="regcol">{{$thisRegistration->fname}}</div>
                        <div class="regcol">{{$thisRegistration->lname}}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="registrationPager">
            <div></div>
            <div>
                {{ $outstandingRegistrations->links() }}
            </div>
        </div>
    </div>
</div>
