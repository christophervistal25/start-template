@extends('templates.dashboard')
@section('title','Activity Logs Archives')
@section('content')
<div class="row">
    <div class="col-md-8" >
        <table class="table">
            <tbody  id="activity-logs">
                <h3 id="instruction-message" class="text-center text-gray-dark text-muted">Select <span class="font-weight-bold"> month </span>and <span class="font-weight-bold">year</span></h3>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-bordered">
            <br>
            <tbody class="text-center">
                <tr class="card border-0">
                    @foreach ($dates as $date)
                    <td style="cursor:pointer;" onclick="return requestArchieves('{{$date->created_at}}')" >
                        <a  class="font-weight-bold text-primary" style="text-decoration:none;">{{ Carbon\Carbon::parse($date->created_at)->format('F Y') }}</a>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection