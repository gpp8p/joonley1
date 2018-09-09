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
        padding:5px;
        margin-left: 10px;
    }
    .explained_label{
        display: grid;
        grid-template-rows: repeat(auto-fill, minmax(30px,0.5fr));
    }
    .accross3{
        display:grid;
        grid-template-columns: 30% 30% 30%;
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

    .selinput {
        width: 50%;
        font-size:15pt;
        height:30px;
        margin-bottom: 5px;
    }

    .subCntr{
        margin-left: 30%;
        margin-top: 20px;
    }

</style>

<script language='javascript' type='text/javascript'>

</script>

<div class="fillFrame">
    <form id="companyEditForm" method="POST">
        {{ csrf_field() }}

        <div class="content_row">
            <div class="explained_label">
                <div class="lab">
                    Company Name:
                </div>
                <div class="explaination">
                    Please enter or edit your company's name:
                </div>
            </div>
            <div class="input_field">
                <input type="text" name="name" id="name" class="wide_input_field" size="50" value ="{{$thisCompanyData->name}}"/>
            </div>
        </div>

    </form>






</div>