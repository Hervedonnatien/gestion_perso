@extends('layouts.app')
@section('contenu')
<div>
        {{ $message ?? '' }}
        <br>
        <br>
</div >
<div class="text-center">
<h4 class="text center">Type de demande</h4>
</div>
<div class="row container">
    <div class=" card col-sm-5">
        <div class="card-header">
            <div class="card-body">
                <form  id="form_add_personnel" method="POST" class="container" action="{{route('createType')}}">
                @csrf
                            <div class="form-group">
                                <label for="num_matri">Libellés :</label>
                                <input type="text" id="libelle" name="libelle" class="form-control form-control-sm" required>
                            </div>
                    <input type="submit" value="Enregistrer" class="btn btn-sm btn-success">
                </form>
            </div>
        </div>
    </div>
<div class="shado col-sm-7 ">
    <table class="table table-striped table-bordered table-hover">
        <thead class=" text-dark  text-center ">
            <th>#</th>
            <th>Libelle</th>
            <th style="width: 50px;">Action</th>
        </thead>
        <tbody>
        @if($types->count()>0)
            @foreach ($types as $type)
            <tr>
                <td>{{$type->id}}</td>
                <td>{{$type->libelle}}</td>
                <td><a href="#" id="type{{$type->id}}" class=" text-primary "><i class="fas fa-edit "></i></a></td>
                <script type="text/javascript">
                        $(document).on('click','#type{{$type->id}}', function(){
                              $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                              $.ajax({
                                   url:'{{route("edit_type_conge",$type->id)}}',
                                method:"get",
                                dataType:'json',
                                success:function(data){
                                $('#id_conge').val(data.type.id);
                                $('#type_conge').val(data.type.libelle);
                                $('#edit_type_conge').modal('show');

                            }
                            });
                          });
                    </script>
            </tr>
            @endforeach
        @else
            <tr class="text-center" style="height: 300px;">
              <td  colspan="7" >
                <div style="margin-top: 120px">
                  <code>Liste vide</code>
                </div>
              </td>
             </tr>
        @endif
        </tbody>
    </table>
</div>
</div>
@endsection