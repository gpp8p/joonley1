@extends('layouts.jheader')


@section('content')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script language='javascript' type='text/javascript'>
        function myFunction(x) {
            alert("Row index is: " + x.id);
        }

        function getOneRegistrationRequest(clickedElement){
            $.ajax({
                /* the route pointing to the post function */
                url: '/getReg',
                type: 'GET',
                /* send the csrf-token and the input to the controller */
                data: {regId:clickedElement.id},
                dataType: 'json',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    alert(data);
                },

                error: function (data) {
                    alert('error');
                }
            });
        }
    </script>
    <div>
        <div class="split left">
            <table border="0" width="100%">
                @foreach ($outstandingRegistrations as $thisRegistration)
                    <tr class="row1" id="{{$thisRegistration->id}}" onclick="getOneRegistrationRequest(this);">
                        <td class="col1">{{$thisRegistration->email}}</td>
                        <td class="col1">{{$thisRegistration->fname}}</td>
                        <td class="col1">{{$thisRegistration->lname}}</td>
                    </tr>
                 @endforeach
            </table>
            {{ $outstandingRegistrations->links() }}
        </div>

        <div class="split right">
            <div class="centered">
                <p>Some text here too.</p>
            </div>
        </div>
    </div>

@endsection