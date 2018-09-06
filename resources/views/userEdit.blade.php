<style>
    .fillFrame{
        background-color: #eeeeee;
        height:100%;
        width:100%;
    }
    .editTitle{
        font-size: 32px;
        color:black;
        font-family: 'Fira Sans Condensed', sans-serif;
        text-align: center;
        padding-top: 5px;
    }

    .content_row{
        display: grid;
        grid-template-columns:20% 80%;
        padding:20px;
        margin-left: 10px;
    }
    .explained_label{
        display: grid;
        grid-template-rows: repeat(auto-fill, minmax(30px,0.5fr));
    }
    .lab{
        font-size: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: 400;
        color: black;
    }
    .explaination{
        font-size: 10px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        margin-right: 5px;
        color: black;
    }
    .wide_input_field{
        font-size: 18px;
        margin-top: 15px;
    }

</style>

<script language='javascript' type='text/javascript'>

</script>

<div class="fillFrame">
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Last Name:
            </div>
            <div class="explaination">
                Please enter or edit your last name:
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="lname" id="product_name" class="wide_input_field" size="40" value ="{{$thisUserData->lname}}"/>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                First Name:
            </div>
            <div class="explaination">
                Please enter or edit your first name:
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="lname" id="product_name" class="wide_input_field" size="40" value ="{{$thisUserData->fname}}"/>
        </div>
    </div>


</div>

