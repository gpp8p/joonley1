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
        grid-template-rows: 50px 100px 85%;
    }
    .optionSelect {
        width:35%;
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
        grid-template-columns: repeat(auto-fill, 25%);
        align-items: center;
        padding-left: 10%;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        height:100px;
        color: black;
    }
    .optionSelect {
        width:35%;
    }
    .selectLabel{

    }
    .selectOptions{
        display:grid;
        grid-template-rows: 20px 85%;
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
    .submitButton{
        width:70px;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
            childNodes.push(['select sub-category of:'+lastAddedCatName[lastAddedCatName.length-1], 0]);
        }else{
            childNodes.push(['all categories - select one', 0]);
        }
        removeSubmitButton();
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
                createSubmitButton();

            },

            error: function (data) {
                alert('error');
            }
        });
    }

    function showDefaultOptions(catId){
        $.ajax({
            /* the route pointing to the post function */
            url: '/getOptionsWithParents',
            type: 'GET',
            /* send the csrf-token and the input to the controller */
            data: {categoryId:catId},
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                for(i=0;i<data.length;i++){
                    var optionHeader = data[i][0];
                    var optionItems = data[i][1];
                    var thisOptionSelect = "<span class='selectOptions' id='sopt"+optionHeader+"'><span class='selectLabel'>"+optionHeader+":</span><select class='optionSelect' size='"+optionItems.length+"' multiple >";
                    var thisOptionHtml="";
                    for(d=0;d<optionItems.length;d++){
                        var thisItemValue = optionItems[d][0];
                        var thisItemId = optionItems[d][1];
                        thisOptionHtml = thisOptionHtml+"<option value=\""+thisItemId+"\" checked \>"+thisItemValue+"\<\/option\>";
                    }
                    thisOptionSelect = thisOptionSelect+thisOptionHtml+"\<\/select\></span>";
                    $("#filters").append(thisOptionSelect);
                    console.log(thisOptionSelect);
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
            showDefaultOptions(elem.value);
            getNextCats(selectedOptionName);
        }

    }

    function gotoParent(elem){
        lastAddedCat.pop();
        lastAddedCatName.pop();
        $("span[id^='sopt']").remove();

        if(lastAddedCatName.length==0){
            getNextCats('Select Product Category')
        }else{
            getNextCats(lastAddedCatName[lastAddedCatName.length-1]);
        }
        removeSubmitButton();


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

    function createSubmitButton(){
        var buttonHtml = "<button id='subb' onclick='submitData();return false;' class='submitButton'>Search</button>";
        $("#filters").append(buttonHtml);
    }

    function removeSubmitButton(){
        $("#subb").remove();
    }

    function submitData(event){
        var selectedCategory = lastAddedCat[lastAddedCat.length-1];
        var optionsPresent = $('.optionSelect');
        var selectedOptionValues = [];
        var submitData = [];
        for(i=0;i<optionsPresent.length;i++){
            var thisOptionSelect = optionsPresent[i];
            var thisSelectedOptions = thisOptionSelect.selectedOptions;
            for(j=0;j<thisSelectedOptions.length;j++){
                var thisOption = thisSelectedOptions[j];
                var thisOptionValue = thisOption.value;
                selectedOptionValues.push(thisOptionValue);
            }
        }
        submitData.push(selectedCategory);
        submitData.push(selectedOptionValues);
        var jsonSubmit = JSON.stringify(submitData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            /* the route pointing to the post function */
            url: '/productSearch',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {searchCriteria:jsonSubmit},
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {

            },

            error: function (data) {
                alert('error');
            }
        });

        return false;
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
        <form action="{{url('/productSearch')}}">
            <div class="filterControls" id="filters">

            <span id="categoryControl">

            </span>


            </div>
        </form>
        <div class='productView'>

        </div>

    </div>

</div>