@if (session('status'))
<div class="card bg-success text-white shadow">
    <div class="card-body">
        <span class="font-weight-bold">{{session('status')}}</span>
    </div>
</div>
@endif
<br>