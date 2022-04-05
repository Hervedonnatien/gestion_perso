@extends('layouts.app')
@section('contenu')
<div>
        {{ $message ?? '' }}
        <br>
        <br>
</div >
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <a href="{{route('sanction_liste')}}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Listes des sanctionées</a>
</div>
<br>
<div class="text-center">
<h4 class="text center">Liste d'absence</h4>
</div>
<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon  elevation-1"><i class="fas fa-users "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Nombre de personnel absent</span>
                <span class="info-box-number">{{$bilans->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
            <br>

<div class="shadow ">
    <table class="table table-striped table-bordered table-hover">
        <thead class=" text-dark  text-center ">
            <th>Numéro matricule</th>
            <th>Nom</th>
            <th>Nombres de jours d'absence</th>
            <th>Sanction</th>
        </theads>
        <tbody>
        @if($bilans->count()>0)
            @foreach ($bilans as $bilan)
            <tr>
                <td>{{$bilan->im}}</td>
                <td>{{$bilan->nom_prenom}}</td>
                <td>{{$bilan->duree}}</td>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                             <select id="a{{$bilan->id}}" class="custom-select custom-select-sm">
                            @if($type_sanctions->count()>0)
                            <option value="">action</option>
                                @foreach ($type_sanctions as $type_sanction)
                            <option value="{{$type_sanction->libelle}}">{{$type_sanction->libelle}}</option>
                                @endforeach
                            @else
                            <option value="">Aucune sanction definie</option>
                            @endif
                        </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" id="sanction_duree{{$bilan->id}}" class="form-control form-control-sm" placeholder="durée du jour de sanction" >
                        </div>
                        <div class="col-md-3">
                             <input type="button" class="btn btn-success btn-block btn-sm" id="sanction{{$bilan->id}}" value="Sanctionner">
                        </div>
                    </div>
                    <script type="text/javascript">
                        
                        $('#sanction{{$bilan->id}}').click(function () {
                                var type_sanction  = $("#a{{$bilan->id}}").val();
                                var duree  = $("#sanction_duree{{$bilan->id}}").val();
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                            if (type_sanction !='' && duree !='' ) {
                            if (confirm('Confirmation !')) {

                                $.ajax({
                                url:"{{route('sanctionner',$bilan->id)}}",
                                method:"get",
                                data:{
                                  nbrs:duree,sanction:type_sanction,
                                },
                                success:function(response){
                                    $('tbody').html(response.output);
                                    location.reload();
                                    }
                                    });
                                    }       
                                }
                                else{
                                    alert('Champ required');
                                }
                        })
                    </script>
                </td>
            @endforeach
        @else
            <tr class="text-center" style="height: 300px;">
              <td  colspan="7" >
                <div style="margin-top: 120px">
                  <code>Aucun bilan d'absence</code>
                </div>
              </td>
             </tr>
        @endif
        </tbody>
    </table>
</div>
@endsection