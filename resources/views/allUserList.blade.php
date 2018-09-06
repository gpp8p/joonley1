<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<style>
    .fillFrame{
        background-color: #eeeeee;
        height:100%;
        width:100%;
    }
    .viewRow{
        display:grid;
        grid-template-columns: 20% 10% 20% 20% 20%;
        grid-template-rows: auto;
        align-items: center;
        margin-left: 5px;
        margin-right: 5px;

    }
    .viewTitles{
        display:grid;
        grid-template-columns: 20% 10% 20% 20% 20%;
        grid-template-rows: auto;
        align-items: center;
        margin-left: 5px;
        margin-right: 5px;

    }
    .titleItem{
        color: #ffffff;
        background-color: #9d9d9d;
    }

    .viewRow:hover
    {
        background-color: #07eefa;
    }
    .viewItem{
        font-size: 16px;
        color:black;
        font-family: 'Fira Sans Condensed', sans-serif;
    }

    .pager{
        display:grid;
        grid-template-columns:70% 10% 20%;
    }
</style>

<script language='javascript' type='text/javascript'>
    var selectUser = function(event, evtId){
        $("#selectedUser").val(evtId);
        $('#userSelect').attr('action', "/userProfileEdit").submit();
        return false;
    }
</script>

<div class="fillFrame">
    <div class="viewTitles">
        <div class="titleItem">
            USERNAME
        </div>
        <div class="titleItem">
            ROLE
        </div>
        <div class="titleItem">
            LAST NAME
        </div>
        <div class="titleItem">
            FIRST NAME
        </div>
        <div class="titleItem">
            EMAIL
        </div>

    </div>
    @foreach($allUsers as $thisUser)
        <div class="viewRow" onclick="selectUser(event, '{{$thisUser->id}}');return null;" id="{{$thisUser->id}}">
            <div class="viewItem">
                {{$thisUser->name}}
            </div>
            <div class="viewItem">
                @if($thisUser->buysell_type == 'B')
                    Buyer
                @else
                    Seller
                @endif
            </div>
            <div class="viewItem">
                {{$thisUser->lname}}
            </div>
            <div class="viewItem">
                {{$thisUser->fname}}
            </div>
            <div class="viewItem">
                {{$thisUser->email}}
            </div>
        </div>

    @endforeach

        <div class="pager">
            <div></div>
            <div>
                {{$allUsers->links()}}
            </div>
        </div>

        <form id="userSelect" method="post">
            {{ csrf_field() }}
            <input type="hidden" id="selectedUser" name="selectedUser" value=""/>
        </form>

</div>

