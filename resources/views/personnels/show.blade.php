@extends('layouts.app')

@section('contenu')
<div class=" ">
    <div class="row">
        <div class="col-sm-2">
            <div class="card" style="width:180px">
              <img class="card-img-top" src="{{asset('photos')}}/personnel/{{$personnel->profile}}" height="200" alt="Card image">
              <a href="#" class="btn btn-primary btn-sm" onclick="mod()">Modifier photo de profile</a>
                <form method="POST" id="frmImg" style="display: none;" action="{{route('updateImage',$personnel->num_matricule)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" id="profile" onchange="document.getElementById('submit').click();" name="profile"><br>
                    <input style="display: none;" type="submit" id="submit" value="Submit">
                </form>
            </div>
        </div>
        <script type="text/javascript">
            // document.getElementById('contenu').style.backgroundImage="url('{{asset('photos')}}/personnel/{{$personnel->profile}}')";
            function mod() {
                // var x =document.getElementById('frmImg').style.display='flex';
                document.getElementById('profile').click();
            }
        </script>
        <div class="col-sm-10">
        <table class="table table-striped  table-hover">
            <thead class="bg-light text-dark ">
                <th>Numéro matricule</th>
                <th>Nom et prenom</th>
                <th>Addresse mail</th>
                <th>téléphone</th>
                <th>Genre</th>
                <th>Situation</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{$personnel->num_matricule}}</td>
                    <td>{{$personnel->nom_prenom}}</td>
                    <td>{{$personnel->email}}</td>
                    <td>{{$personnel->telephone}}</td>
                    <td>{{$personnel->sexe}}</td>
                    <td>{{$personnel->situation_familiale}}</td>
                </tr>   
            </tbody>
        </table>
            {!!$warning!!}
            <div class="container"><strong>Identité secret :   <span class="text-success">{{$personnel->secret_identity}}</span></strong></div>
            <div class="row" style="margin-top: 100px">
                <div class="offset-md-5 col-sm-6">
                    <div class="row">
                    <div class="col-sm-6 ">
                        <input type="button" id="edit_p" class="btn btn-sm btn-primary" style="width: 200px" value="Modifier">
                    </div>
                    <script type="text/javascript">
                        $(document).on('click','#edit_p', function(){
                            $('#form_ed').attr('action','{{route("update",$personnel->num_matricule)}}');
                              $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                              $.ajax({
                                   url:'{{route("edit_pers",$personnel->num_matricule)}}',
                                method:"get",
                                dataType:'json',
                                success:function(data){
                                $('#im_edit').val(data.data.num_matricule);
                                $('#name_edit').val(data.data.nom_prenom);
                                $('#email_edit').val(data.data.email);
                                $('#tel_edit').val(data.data.telephone);
                                $('#situation_edit').val(data.data.situation_familiale);
                                $('#modal_personnel_edit').modal('show');

                            }
                            });
                          });
                    </script>
                    @if($has_account_user )
                        @if($has_account_user->role!='ROLE_ADMIN' )
                        <div class="col-sm-6 ">
                            <form action="{{route('delete',$personnel->num_matricule)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="btn btn-sm btn-danger" value="Supprimer" style="width: 200px">
                            </form>
                        @endif
                    @endif
                    </div>                    
                    </div>
                </div>
                
            </div>
        </div>
    </div>
   
</div>


@endsection