<div class="modal fade" id="modal_personnel">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Nouvel personnel</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action="{{route('store')}}" method="post">
          <div class="form-group">
          <input  type="text"  required name="num_matricule" id="im" placeholder="Numéro matricule" class="form-control form-control-sm">
          </div>
          <div class="form-group">
            <input  type="text"  required  name="name" id="name" value="" placeholder="Nom complet" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <input  type="email" required  name="email" id="email" placeholder="E-mail" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <input  type="text"  required name="telephone" id="tel" placeholder="Téléphone" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <select  name="sexe"  required id="sexe" aria-placeholder="Sexe" class="custom-select custom-select-sm">
                    <option value="Masculin">Masculin</option>
                    <option value="Feminin">Feminin</option>
                </select>
            </div>
            <div class="form-group">
                <select  name="situation" id="situation" class="custom-select custom-select-sm">
                   <option value="Célibataire">Célibataire</option>
                    <option value="Marié(e)">Marié(e)</option>
                </select>
            </div> 
            @csrf
          <input type="submit" class="btn btn-success btn-sm float-right" value="Ajouter">
        </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_personnel_edit">
    <div class="modal-dialog bg-dark">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modification</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form id="form_ed" method="post">
          <div class="form-group">
          <input  type="text" disabled name="im" id="im_edit" placeholder="Numéro matricule" class="form-control form-control-sm">
          </div>
          <div class="form-group">
            <input  type="text"  required  name="name" id="name_edit" placeholder="Nom complet" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <input  type="email" required  name="email" id="email_edit" placeholder="E-mail" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <input  type="text"  required name="telephone" id="tel_edit" placeholder="Téléphone" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <select  name="situation" id="situation_edit" class="custom-select custom-select-sm">
                    <option value="Célibataire">Célibataire</option>
                    <option value="Marié(e)">Marié(e)</option>
                </select>
            </div> 
            @method('PUT')
            @csrf
          <input type="submit" class="btn btn-success btn-sm float-right" value="Sauvegarder">
        </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>

<div class="modal fade" id="deconnexion">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Deconnexion</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="jumbotron" style="font-size: 20px">
            Voulez-vous vous deconnecter?
          </div>
          <div class="row">
            <div class="col-md-6">
            <a class="btn btn-danger btn-sm text-center" style="width: 200px" href="/deconnexion">Oui</a>
            </div>
            <div class="col-md-6 text-center">
            <a class="btn btn-success btn-sm " style="width: 200px" href="#" data-dismiss="modal">Non</a>
            </div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>

  <div class="modal fade" id="edit_type_sanction">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Type sanction</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="{{route('update_type_sanction')}}">
            @csrf()
            @method('PUT')
            <input type="text" name="type" id="type_sanction" class="form-control form-control-sm">
            <input type="hidden" name="id_sanction" id="id_sanction">
            <br>
            <br>
            <div class="row">
            <div class="col-md-6">
            <input type="submit"  class="btn btn-success btn-sm text-center" style="width: 200px" value="Changer">
            </div>
          </div>
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>


  <div class="modal fade" id="edit_type_conge">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Type Conge</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="{{route('update_type_conge')}}">
            @csrf()
            @method('PUT')
            <input type="text" name="type_conge" id="type_conge" class="form-control form-control-sm">
            <input type="hidden" name="id_conge" id="id_conge">
            <br>
            <br>
            <div class="row">
            <div class="col-md-6">
            <input type="submit"  class="btn btn-success btn-sm text-center" style="width: 200px" value="Changer">
            </div>
          </div>
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>

