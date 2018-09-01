<style>

    .fillFrame{
        background-color: #eeeeee;
        height:100%;
        width:100%;
    }
    .viewRow{
        display:grid;
        grid-template-columns: 40% 20% 40%;
        grid-template-rows: auto;
        align-items: center;

    }
    .previewBody{
        display: grid;
        grid-template-rows: auto;
        border: 2px solid #092aff;
        background-color: #eeeeee;
        border-radius: 10px;
        height:85%;
        max-width:100%;
        margin-top: 30%;
        padding-left: 3px;
        padding-right: 3px;
        padding-bottom: 20px;
    }
    .pname {
        color: black;
        align-self: center;
        text-align: center;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 18px;
    }
    .pimage{

    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5px;

    }
    .pdescription{
        color:black;
        text-align: center;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 18px;
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
        padding:6px 16px;
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

    .ifooter{
        margin-left: 5%;
        margin-right: 5%;
        padding-top: 15px;

    }

    .heart{
        color: #5262ff;
        margin-right: 15px;
        vertical-align: bottom;
    }
    .shop{
        vertical-align: top;
    }
    .formButtons{
        display:grid;
        grid-template-columns: 33% 33% 33%;
        padding-left: 20%;
        padding-top: 20px;



    }
    .formRow{
        display:grid;
        grid-auto-rows: auto;

    }
    .brow{
        padding-top: 20px;
    }
    .bitem{
        width: 30%;
        text-align: center;
    }



</style>

<script language='javascript' type='text/javascript'>


</script>
<form method="POST" class="fillFrame">
    <div class="fillFrame">
        <div class="viewRow">
            <div>

            </div>
            <div class="formRow">
                <div class="previewBody">
                    <div class="pname">
                        {{$viewData['product_name']}}
                    </div>
                    <div class="pimage">
                        <img src="{{$viewData['image_url']}}"
                    </div>
                    <div class="pdescription">
                    <textarea cols="32" rows="8">
                        {{ $viewData['product_description'] }}
                    </textarea>
                    </div>
                    <div class="ifooter">
                        <span class="heart"><i class="fa fa-heart"></i></span><span class="heart"><i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i></span><span class="heart"><i class="fa fa-reply" aria-hidden="true"></i></span><span class="shop"><a href="#" class="but1">View Shop</a></span>
                    </div>
                </div>
            </div>
            <div>

            </div>
        </div>
    </div>
    <div class="formButtons">
        <span class="bitem"><a href="#" class="but1">Back</a></span>
        <span class="bitem"><a href="#" class="but1">Add to Feed</a></span>
        <span class="bitem"><a href="#" class="but1">Cancel</a></span>
    </div>
</form>





