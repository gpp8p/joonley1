<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<style>
    .fillFrame{
        background-color: #eeeeee;
        height:100%;
        width:100%;
    }

    .pager{
        display:grid;
        grid-template-columns:70% 10% 20%;
    }
    .buyerViewWrapper{
        display:grid;
        grid-template-rows: 50px 50px 95%;
    }
    .filterControls{

        display:grid;
        grid-template-columns: repeat(auto-fill, 30%);
        align-items: center;
        padding-left: 20%;
    }
    .pageTitle{

        display:grid;
        grid-template-columns: repeat(auto-fill, 30%);
        color: black;
        align-items: center;
        padding-left: 20px;
    }
    .filterControls{
        display:grid;
        grid-template-columns: repeat(auto-fill, 30%);
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        color: black;
    }
    .flushLeft{
        justify-self: start;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
    }
    .titleCentered{
        justify-self: center;
        font-size: 24px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
    }
    .flushRight{
        justify-self: end;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
    }
    .productView{

    }
</style>

<script language='javascript' type='text/javascript'>
    var lastAddedCat = [];
    var lastAddedCatName =[];
    $( document ).ready(function() {
        lastAddedCatName.push('Select Product Category');
        lastAddedCat.push(0);
        getNextCats('Select Product Category')
    });


    function getNextCats(parentCatName){
        var childNodes = [];
        if(lastAddedCatName.length>1) {
            childNodes.push(['select category', 0]);
        }else{
            childNodes.push(['all categories - select one', 0]);
        }
        $.ajax({
            /* the route pointing to the post function */
            url: '/getCats',
            type: 'GET',
            /* send the csrf-token and the input to the controller */
            data: {parentCategoryName:parentCatName},
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                for(i=0;i<data.length;i++){
                    childNodes.push(data[i]);
                }
                if(data.length>0){
                    var selHtml = createNextSelect(childNodes);
                    $("#categoryControl").html(selHtml);

                }else{
                    var selHtml = createLeafSelect();
                    $("#categoryControl").html(selHtml);
                }
            },

            error: function (data) {
                alert('error');
            }
        });
    }

    function newSubCat(elem){
        if(elem.selectedOptions[0].innerText == 'Select Parent'){
            gotoParent(elem);
        } else{
            var selectedOptionName = elem.selectedOptions[0].innerText;
            lastAddedCat.push(elem.value);
            lastAddedCatName.push(selectedOptionName);
            getNextCats(selectedOptionName);
        }

    }

    function gotoParent(elem){
        lastAddedCat.pop();
        lastAddedCatName.pop();
        if(lastAddedCatName.length==0){
            getNextCats('Select Product Category')
        }else{
            getNextCats(lastAddedCatName[lastAddedCatName.length-1]);
        }

    }

    function createNextSelect(optNames){
        var thisDivHtml = "<select id ='categorySelect' onchange='newSubCat(this);' id='nxt_selector'>";
        for(i=0;i<optNames.length;i++){
            var newOpt = "<option value='"+optNames[i][1]+"'>"+optNames[i][0]+"</option>";
            thisDivHtml = thisDivHtml+newOpt;
        }
        thisDivHtml = thisDivHtml + "<option value='-1'>Select Parent</option>"
        thisDivHtml = thisDivHtml+"</select>";
        return thisDivHtml;
    }

    function createLeafSelect(){
        var thisDivHtml = "<select id ='categorySelect' onchange='gotoParent(this);'>";
        var newOpt = "<option value='0'>No Sub-Categories Under:"+lastAddedCatName[lastAddedCatName.length-1]+"</option>";
        var newOpt = newOpt+"<option value='-1'>Select Parent</option>";
        thisDivHtml = thisDivHtml+newOpt;
        thisDivHtml = thisDivHtml+"</select>";
        return thisDivHtml;
    }


</script>

<div class="fillFrame">
    <div class="buyerViewWrapper">
        <div class="pageTitle">
            <span class="flushLeft">
                <<- Previous Step
            </span>
            <span class="titleCentered">
                Select Items
            </span>
            <span class="flushRight">
                Next Step ->>
            </span>
        </div>
        <div class="filterControls">
            <span id="categoryControl">

            </span>
            <span id="option1">
                <select id="optionSelect">
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                    <option>Option 4</option>
                    <option>Option 5</option>
                    <option>Option 6</option>
                    <option>Option 7</option>
                    <option>Option 8</option>
                </select>
            </span>

        </div>
        <div class='productView'>

        </div>

    </div>

</div>