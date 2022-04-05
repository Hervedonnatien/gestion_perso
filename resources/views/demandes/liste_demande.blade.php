@extends('layouts.app')

@section('contenu')
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
	<form method="GET" style="position: absolute;right: 0px">
    <input type="date" class=" form-control form-control-sm" placeholder="">

	</form>
</div> -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{route('demande.accepted')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Listes congés</a>

    <a href="{{route('demande.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Ajouter congés</a>
</div>
<br>
<div class="text-center">
<h4 class="text center">Listes des demandes</h4>
</div>


<div class="shadow ">
    <table class="table table-striped table-bordered table-hover">
        <thead class=" text-dark  text-center ">
            <th>Numero matricule</th>
            <th>Debut</th>
            <th>Fin</th>
            <th>Motif</th>
            <!-- <th>statut</th> -->
            <th>Date de demande</th>
            <th>Action</th>
        </theads>
        <tbody>
        @if($demandes->count()>0)
            @foreach ($demandes as $demande)
            <tr>
                <td>{{$demande->personnel_num_matricule}}</td>
                <td>{{$demande->date_debut}}</td>
                <td>{{$demande->date_fin}}</td>
                <td>{{$demande->motif}}</td>
                <!-- <td>{{$demande->status}}</td> -->
                <td>{{$demande->created_at}}</td>
                <td>
                    <div class="row">
                        <div class="col-sm-8">
                             <select id="act{{$demande->id}}" class="custom-select custom-select-sm">
                            <option value="">action</option>
                            <option value="accept">Approuver</option>
                            <option value="delete">Supprimer</option>
                        </select>
                        </div>
                        <div class="col-sm-4">
                          <input type="button" class="btn btn-success btn-sm btn-block" id="ok{{$demande->id}}" value="ok">  
                        </div>
                    </div>
                    </form>
                    <script type="text/javascript">
                        
                        $('#ok{{$demande->id}}').click(function () {
                            if (confirm('Confirmation !')) {
                                var formData  = $("#act{{$demande->id}}").val();
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                          $.ajax({
                            url:"{{route('decision',$demande->id)}}",
                            method:"get",
                            data:{
                              all_data:formData,
                            },
                            success:function(response){
                                $('tbody').html(response.output);
                                }
                                });
                            }  
                        })
                    </script>
                </td>
            @endforeach
        @else
            <tr class="text-center" style="height: 300px;">
              <td  colspan="7" >
                <div style="margin-top: 120px">
                  <code>Aucun demande</code>
                </div>
              </td>
             </tr>
        @endif
        </tbody>
    </table>
</div>
@endsection