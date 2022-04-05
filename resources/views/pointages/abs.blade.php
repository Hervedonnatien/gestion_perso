  @extends('layouts.app')

@section('contenu')
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
	<form method="GET" style="position: absolute;right: 0px">
    <input type="date" class=" form-control form-control-sm" placeholder="">

	</form>
</div> -->
<?php 
function date_comple($date1)
      {
        $tab_mois= array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre');
        $date_done=date('d',strtotime($date1)).' '.$tab_mois[date('m',strtotime($date1))-1].' '.date('Y',strtotime($date1));
        return $date_done;
      }
 ?>
<br>
<div class="text-center">
<h4 class="text center">Liste de personnel absent le {{date_comple($date)}}</h4>
</div>
<form  id="form_add_personnel" class="float-right"  method="get"  action="{{route('absent_date')}}">
                @csrf
                    <input type="date" id="date" name="date" value="{{$date ?? ''}}" required>
                    <input type="submit" value="Consulter" >
                </form>
<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon  elevation-1"><i class="fas fa-users "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Absent</span>
                <span class="info-box-number">{{$absences->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
            <br>

<div class="shadow ">
    <table class="table table-striped table-bordered table-hover">
        <thead class=" text-light  text-center bg-danger ">
            <th>Numéro matricule</th>
            <th>Nom</th>
            <th>Information</th>
        </theads>
        <tbody>
        @if($absences->count()>0)
            @foreach ($absences as $absence)
            <tr>
                <td>{{$absence->im}}</td>
                <td>{{$absence->nom_prenom}}</td>
                <td width="20px"><a href="{{route('show',$absence->im)}}" class=" text-primary "><i class="fas fa-eye "></i></a></td>
            @endforeach :
        @else
            <tr class="text-center" style="height: 300px;">
              <td  colspan="7" >
                <div style="margin-top: 120px">
                  <code>Aucun personnel absent du <kbd>{{date_comple($date)}}</kbd></code>
                </div>
              </td>
             </tr>
        @endif
        </tbody>
    </table>
</div>
@endsection