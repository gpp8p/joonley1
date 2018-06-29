@extends('layouts.jheader')


@section('content')
    <script language='javascript' type='text/javascript'>

    </script>
    <div>
        <div class="split left">
            <table border="0" width="100%">
                @foreach ($outstandingRegistrations as $thisRegistration)
                    <tr class="row1">
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