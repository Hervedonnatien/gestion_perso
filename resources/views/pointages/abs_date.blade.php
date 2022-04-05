@extends('layouts.app')
@section('contenu')
<div>
        {{ $message ?? '' }}
        <br>
        <br>
</div >
<div class="text-center">
<h4 class="text center">Indication du date </h4>
</div>
<div class="row  " style="margin-top: 100px">
    <div class="bg-dark card col-sm-3 offset-lg-4">
        <div class="card-header">
            <div class="card-body">
                <form  id="form_add_personnel" method="get" class="container" action="{{route('absent_date')}}">
                @csrf
                            <div class="form-group">
                                <input type="date" id="date" name="date" class="form-control form-control-sm" required>
                            </div>
                    <div class="text-center">
                    <input type="submit" value="Consulter" class="btn btn-sm btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection