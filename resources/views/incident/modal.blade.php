<!-- Modal make facture -->
<div class="modal fade" id="facture-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informations de l'incident</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="product-form">
                    @csrf
{{--                    <input type="hidden" name="iddevis" id="iddevis" value="" required>--}}
                    <div class="form-group">
                        <label for="serie">Numero de serie<span class="text-danger">*</span></label>
                        <input type="text" name="num_serie" id="num_serie" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="marque">Marque <span class="text-danger">*</span></label>
                        <input type="text" name="marque"  id="marque" placeholder="Marque" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Modele <span class="text-danger">*</span></label>
                        <input type="text" name="modele" id="modele"   class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="model">prix <span class="text-danger">*</span></label>
                        <input type="number" name="prix" id="prix" step="any" min="0"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="accessoirs">Accessoires <span class="text-danger" aria-placeholder="chargeur,batterie....">*</span></label>
                        <input type="text" name="accessoirs" id="accessoirs"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description du probleme </label>
                        <textarea name="description_probleme" id="description" placeholder="Description probleme"
                                  class="form-control"></textarea>
                    </div>
                    <div class="form-group" id="etat-block">
                        <label class="text-left pl-3">Etat du systeme</label>
                    <div class="col-md-15 form-group">
                        <select   class="form-control" id="systeme_etat" name="systeme_etat">
                            <option value="1" >Totalement operationnel</option>
                            <option value="2" >Intervention a continuer</option>
                        </select>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-primary" id="addFields">Ajouter</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
